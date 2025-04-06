<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\DataTables\EmployeeTaskDataTable;
use App\DataTables\EmployeeClassDataTable;
use App\DataTables\EmployeeMeetingDataTable;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view('employee.dashboard.homepage');
    }


    public function meeting(EmployeeMeetingDataTable $table)
    {
        return $table->render('employee.meeting.index');

    }

    public function class(EmployeeClassDataTable $table)
    {
        return $table->render('employee.class.index');

    }

    public function task(EmployeeTaskDataTable $table)
    {
        return $table->render('employee.task.index');

    }

    public function meeting_show($id)
    {
        $meeting = Meeting::find($id);

        return view('employee.meeting.show')->with('meeting', $meeting);

    }
}
