<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\User;
use App\Models\Batch;
use App\Http\Requests;
use App\Models\Meeting;
use App\Models\BatchUser;
use Illuminate\Http\Request;
use App\DataTables\BatchesDataTable;
use App\DataTables\CourcesDataTable;
use App\Repositories\CourcesRepository;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCourcesRequest;
use App\Http\Requests\UpdateCourcesRequest;

class BatchesController extends AppBaseController
{

    public function index(BatchesDataTable $table)
    {
        if (\Auth::user()->can('manage-user')) {
            return $table->render('batches.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new Cources.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::where('type','user')->where('payment_status',1)->pluck('name', 'id')->toArray();
        return view('batches.create',compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'end_date' => 'required',
        ]);

        $model = new Batch();
        $model->title = $request->title;
        $model->description = $request->description;
        $model->start_date = now();
        $model->end_date = $request->end_date;
        $model->save();


        foreach ($request->users as $user_id) {
            BatchUser::create([
                'batch_id' => $model->id,
                'user_id' => $user_id,
            ]);
        }

        Session::flash('success', 'Batch saved successfully.');

        return redirect(route('batches.index'));
    }

    /**
     * Display the specified Cources.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $batch = Batch::find($id);

        if (empty($batch)) {
            Session::flash('failed', 'Batch not found');

            return redirect(route('cources.index'));
        }

        return view('cources.show')->with('cources', $cources);
    }

    /**
     * Show the form for editing the specified Cources.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $batch = Batch::find($id);

        $user_ids = BatchUser::where('batch_id', $batch->id)->pluck('user_id');

        $selectedusers = User::whereIn('id',$user_ids)->pluck('id')->toArray();

        $users = User::where('type','user')->where('payment_status',1)->pluck('name', 'id')->toArray();
        if (empty($batch)) {
            Session::flash('failed', 'Batch not found');

            return redirect(route('batches.index'));
        }

        return view('batches.edit',compact('batch','users','selectedusers'));
    }

    /**
     * Update the specified Cources in storage.
     *
     * @param int $id
     * @param UpdateCourcesRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'end_date' => 'required',
        ]);

        $model = Batch::find($id);
        $model->title = $request->title;
        $model->description = $request->description;
        $model->start_date = now();
        $model->end_date = $request->end_date;
        $model->status = $request->status;
        $model->save();

        $batch_users = BatchUser::where('batch_id',$id)->get();
        if($batch_users){
            foreach ($batch_users as $user) {
                $user->delete();
            }
        }

        foreach ($request->users as $user_id) {
            BatchUser::create([
                'batch_id' => $model->id,
                'user_id' => $user_id,
            ]);
        }

        Session::flash('success', 'Batch updated successfully.');

        return redirect(route('batches.index'));

    }

    /**
     * Remove the specified Cources from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);

        if (empty($batch)) {
            Session::flash('failed', 'Batch not found');

            return redirect(route('batches.index'));
        }

        $batch_users = BatchUser::where('batch_id',$id)->get();
        if($batch_users){
            foreach ($batch_users as $user) {
                $user->delete();
            }
        }

        $meetings = Meeting::where('batch_id',$id)->get();
        if($meetings){
            foreach ($meetings as $meeting) {
                $meeting->delete();
            }
        }

        // Delete the category
        $batch->delete();

        Session::flash('success', 'Batch deleted successfully.');

        return redirect(route('batches.index'));
    }


    public function getUserData($batchId)
    {
        // Fetch related data based on batch ID
        $user_ids = BatchUser::where('batch_id', $batchId)->pluck('user_id');

        $users = User::whereIn('id',$user_ids)->pluck('name','id');
        return response()->json($users);
    }
}
