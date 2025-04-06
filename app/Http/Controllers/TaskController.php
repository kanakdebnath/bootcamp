<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\User;
use App\Models\Batch;
use App\Models\Meeting;
use App\Models\BatchUser;
use Illuminate\Http\Request;
use App\DataTables\TaskDataTable;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateCourcesRequest;
use App\Models\Task;

class TaskController extends AppBaseController
{

    public function index(TaskDataTable $table)
    {
        if (\Auth::user()->can('manage-task')) {
            return $table->render('tasks.index');
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
        $users = User::where('type','admin')->where('admin_type','employee')->pluck('name', 'id')->toArray();
        return view('tasks.create',compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'employee_id' => 'required',
        ]);

        $model = new Task();
        $model->title = $request->title;
        $model->details = $request->details;
        $model->employee_id = $request->employee_id;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->save();

        Session::flash('success', 'Task saved successfully.');

        return redirect(route('task.index'));
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
        $task = Task::find($id);

        $users = User::where('type','admin')->where('admin_type','employee')->pluck('name', 'id')->toArray();
        if (empty($task)) {
            Session::flash('failed', 'Task not found');

            return redirect(route('task.index'));
        }

        return view('tasks.edit',compact('task','users'));
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
            'start_date' => 'required',
            'end_date' => 'required',
            'employee_id' => 'required',
        ]);

        $model = Task::find($id);
        $model->title = $request->title;
        $model->details = $request->details;
        $model->employee_id = $request->employee_id;
        $model->status = $request->status;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->save();


        Session::flash('success', 'Task updated successfully.');

        return redirect(route('task.index'));

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
        $task = Task::find($id);

        if (empty($task)) {
            Session::flash('failed', 'Task not found');

            return redirect(route('task.index'));
        }


        // Delete the category
        $task->delete();

        Session::flash('success', 'Task deleted successfully.');

        return redirect(route('task.index'));
    }



    public function status_change(Request $request)
    {

        $request->validate([
            'status' => 'required',
            'note' => 'required',
        ]);

        $task = Task::find($request->id);
        $task->status = $request->status;
        $task->note = $request->note;
        $task->save();

        return response()->json(['message' => 'Task Status Change successfully.']);

    }

}
