<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Batch;
use App\Models\LiveClass;
use App\Models\RecordClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\DataTables\RecordClassDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateCourcesRequest;

class RecordClassController extends AppBaseController
{

    public function index(RecordClassDataTable $table)
    {
        if (\Auth::user()->can('manage-user')) {
            return $table->render('record-class.index');
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
        $batches = Batch::where('status','Active')->pluck('title', 'id')->toArray();
        return view('record-class.create',compact('batches'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'topics' => 'required|string',
            'batch' => 'required',
            'link' => 'required',
            'password' => 'required',
        ]);

        $datetimeString = $request->input('datetime'); // e.g., "03/17/2025 21:00"

        // Try parsing as 24-hour format (MM/DD/YYYY HH:mm)
        try {
            $datetime = Carbon::createFromFormat('m/d/Y H:i', $datetimeString);
        } catch (\Exception $e) {
            // If 24-hour format fails, try 12-hour format (MM/DD/YYYY hh:mm A)
            $datetime = Carbon::createFromFormat('m/d/Y h:i A', $datetimeString);
        }

        // Extract date and time
        $date = $datetime->format('Y-m-d'); // e.g., "2025-03-17"
        $time = $datetime->format('H:i:s'); // e.g., "21:00:00"

        $main_date_time = $datetime->format('Y-m-d H:i:s');

        $model = new RecordClass();
        $model->topics = $request->topics;
        $model->password = $request->password;
        $model->batch_id = $request->batch;
        $model->date = $date;
        $model->status = 'Pending';
        $model->main_date_time = $main_date_time;
        $model->time = $time;
        $model->link = $request->link;
        $model->save();

        Session::flash('success', 'Record Class saved successfully.');

        return redirect(route('record-classes.index'));
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
        $cources = $this->courcesRepository->find($id);

        if (empty($cources)) {
            Flash::error('Cources not found');

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
        $class = RecordClass::find($id);
        $batches = Batch::where('status','Active')->pluck('title', 'id')->toArray();
        return view('record-class.edit',compact('batches','class'));
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
            'topics' => 'required|string',
            'batch' => 'required',
            'link' => 'required',
            'password' => 'required',
        ]);

        $datetimeString = $request->input('datetime'); // e.g., "03/17/2025 21:00"

        // Try parsing as 24-hour format (MM/DD/YYYY HH:mm)
        try {
            $datetime = Carbon::createFromFormat('m/d/Y H:i', $datetimeString);
        } catch (\Exception $e) {
            // If 24-hour format fails, try 12-hour format (MM/DD/YYYY hh:mm A)
            $datetime = Carbon::createFromFormat('m/d/Y h:i A', $datetimeString);
        }

        // Extract date and time
        $date = $datetime->format('Y-m-d'); // e.g., "2025-03-17"
        $time = $datetime->format('H:i:s'); // e.g., "21:00:00"

        $main_date_time = $datetime->format('Y-m-d H:i:s');


        $model = RecordClass::find($id);

        if (empty($model)) {
            Session::flash('failed', 'Record Class not found');

            return redirect(route('classes.index'));
        }

        $model->topics = $request->topics;
        $model->batch_id = $request->batch;
        $model->date = $date;
        $model->time = $time;
        $model->main_date_time = $main_date_time;
        $model->password = $request->password;
        $model->link = $request->link;
        $model->save();

        Session::flash('success', 'Record Class updated successfully.');

        return redirect(route('record-classes.index'));

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
        $class = RecordClass::find($id);

        if (empty($class)) {
            Session::flash('failed', 'Record Class not found');

            return redirect(route('record-classes.index'));
        }

        $class->delete();

        Session::flash('success', 'Record Class deleted successfully.');

        return redirect(route('record-classes.index'));
    }
}
