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
use Illuminate\Http\Request;
use App\DataTables\BatchesDataTable;
use App\DataTables\CourcesDataTable;
use App\DataTables\MeetingDataTable;
use App\Repositories\CourcesRepository;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCourcesRequest;
use App\Http\Requests\UpdateCourcesRequest;

class MeetingController extends AppBaseController
{

    public function index(MeetingDataTable $table)
    {
        if (\Auth::user()->can('manage-user')) {
            return $table->render('meeting.index');
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
        $users = User::where('type','admin')->where('id','!=',1)->pluck('name', 'id')->toArray();
        return view('meeting.create',compact('batches','users'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'topics' => 'required|string',
            'batch' => 'required',
            'user' => 'required',
            'link' => 'required',
            'datetime' => 'required',
            'employee_id' => 'required',
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

        // Combine date and time into a Carbon instance
        $newDateTime = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $date . ' ' . $time
        );

        // Define the 1-hour window
        $startWindow = $newDateTime->copy()->subHour();
        $endWindow = $newDateTime->copy()->addHour();

        // Check if there's an existing record within the 1-hour window
        $conflictExists = Meeting::where('employee_id', $request->employee_id)
            ->whereBetween('main_date_time', [$startWindow, $endWindow])
            ->exists();

        if($conflictExists){
            return redirect()->back()->with('failed','Employee Booked in this time');
        }

        $model = new Meeting();
        $model->topics = $request->topics;
        $model->batch_id = $request->batch;
        $model->user_id = $request->user;
        $model->employee_id = $request->employee_id;
        $model->description = $request->description;
        $model->main_date_time = $main_date_time;
        $model->date = $date;
        $model->time = $time;
        $model->link = $request->link;
        $model->zoom_id = $request->zoom_id;
        $model->zoom_pass = $request->zoom_pass;
        $model->save();

        Session::flash('success', 'Meeting saved successfully.');

        return redirect(route('meetings.index'));
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

        $meeting = Meeting::find($id);
        $batches = Batch::where('status','Active')->pluck('title', 'id')->toArray();

        $user_ids = BatchUser::where('batch_id', $meeting->batch_id)->pluck('user_id');
        $users = User::whereIn('id',$user_ids)->pluck('name','id');

        $employees = User::where('type','admin')->where('id','!=',1)->pluck('name', 'id')->toArray();

        return view('meeting.edit',compact('batches','meeting','users','employees'));

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
            'user' => 'required',
            'link' => 'required',
            'datetime' => 'required',
            'employee_id' => 'required',
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

        // Combine date and time into a Carbon instance
        $newDateTime = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $date . ' ' . $time
        );

        // Define the 1-hour window
        $startWindow = $newDateTime->copy()->subHour();
        $endWindow = $newDateTime->copy()->addHour();

        // Check if there's an existing record within the 1-hour window
        $conflictExists = Meeting::where('id','!=',$id)->where('employee_id', $request->employee_id)
            ->whereBetween('main_date_time', [$startWindow, $endWindow])
            ->exists();

        if($conflictExists){
            return redirect()->back()->with('failed','Employee Booked in this time');
        }


        $model = Meeting::find($id);

        if (empty($model)) {
            Session::flash('failed', 'Meeting not found');
            return redirect(route('meetings.index'));
        }

        $model->topics = $request->topics;
        $model->batch_id = $request->batch;
        $model->user_id = $request->user;
        $model->employee_id = $request->employee_id;
        $model->description = $request->description;
        $model->main_date_time = $main_date_time;
        $model->date = $date;
        $model->time = $time;
        $model->status = $request->status;
        $model->link = $request->link;
        $model->zoom_id = $request->zoom_id;
        $model->zoom_pass = $request->zoom_pass;
        $model->save();

        Session::flash('success', 'Meeting updated successfully.');

        return redirect(route('meetings.index'));

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
        $meeting = Meeting::find($id);

        if (empty($meeting)) {
            Session::flash('failed', 'Meeting not found');

            return redirect(route('meetings.index'));
        }

        $meeting->delete();

        Session::flash('success', 'Meeting deleted successfully.');

        return redirect(route('meetings.index'));
    }

    public function status_change(Request $request)
    {

        $request->validate([
            'status' => 'required',
            'note' => 'required',
        ]);

        $meeting = Meeting::find($request->id);
        $meeting->status = $request->status;
        $meeting->note = $request->note;
        $meeting->save();

        return response()->json(['message' => 'Meeting Status Change successfully.']);

    }
}
