<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Batch;
use App\Http\Requests;
use App\Models\Meeting;
use App\Models\BatchUser;
use App\Models\LiveClass;
use Illuminate\Http\Request;
use App\DataTables\ClassDataTable;
use App\DataTables\BatchesDataTable;
use App\DataTables\CourcesDataTable;
use App\DataTables\MeetingDataTable;
use App\Repositories\CourcesRepository;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCourcesRequest;
use App\Http\Requests\UpdateCourcesRequest;

class ClassController extends AppBaseController
{

    public function index(ClassDataTable $table)
    {
        if (\Auth::user()->can('manage-user')) {
            return $table->render('class.index');
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
        return view('class.create',compact('batches'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'topics' => 'required|string',
            'batch' => 'required',
            'link' => 'required',
            'datetime' => 'required',
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


        $model = new LiveClass();
        $model->topics = $request->topics;
        $model->batch_id = $request->batch;
        $model->description = $request->description;
        $model->date = $date;
        $model->main_date_time = $main_date_time;
        $model->time = $time;
        $model->link = $request->link;
        $model->zoom_id = $request->zoom_id;
        $model->zoom_pass = $request->zoom_pass;
        $model->save();

        Session::flash('success', 'Live Class saved successfully.');

        return redirect(route('classes.index'));
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
        $class = LiveClass::find($id);
        $batches = Batch::where('status','Active')->pluck('title', 'id')->toArray();
        return view('class.edit',compact('batches','class'));
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
            'datetime' => 'required',
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

        $model = LiveClass::find($id);

        if (empty($model)) {
            Session::flash('failed', 'Live Class not found');

            return redirect(route('classes.index'));
        }

        $model->topics = $request->topics;
        $model->batch_id = $request->batch;
        $model->description = $request->description;
        $model->date = $date;
        $model->time = $time;
        $model->main_date_time = $main_date_time;
        $model->link = $request->link;
        $model->zoom_id = $request->zoom_id;
        $model->zoom_pass = $request->zoom_pass;
        $model->save();

        Session::flash('success', 'Live Class updated successfully.');

        return redirect(route('classes.index'));

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
        $class = LiveClass::find($id);

        if (empty($class)) {
            Session::flash('failed', 'Live Class not found');

            return redirect(route('classes.index'));
        }

        $class->delete();

        Session::flash('success', 'Live Class deleted successfully.');

        return redirect(route('classes.index'));
    }
}
