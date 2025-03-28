<?php

namespace App\Http\Controllers\frontend;

use App\Models\Event;
use App\Models\Cources;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LiveClass;
use App\Models\RecordClass;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('frontend.dashboard');
    }

    public function profile()
    {
        return view('frontend.profile');
    }


    public function courseDetails ()
    {
        $user = Auth::user();
        if($user->status == 'expired'){
            return redirect()->route('user.course')->with('warning', 'Your course is already complete!');
        }else{
            $course = Cources::where('course_type','course')->latest()->first();
            return view('frontend.course-details',compact('course','user'));
        }
    }


    public function meeting()
    {
        $meetings = Meeting::where('status','Started')->where('user_id',auth()->id())->latest()->paginate(10);

        return view('frontend.meeting',compact('meetings'));
    }

    public function services()
    {
        $services = Service::where('status','Active')->latest()->get();

        return view('frontend.service',compact('services'));
    }

    public function serviceDetails($id)
    {

        $service = Service::findOrFail($id);

        return view('frontend.service-details',compact('service'));
    }

    public function class()
    {
        $classes = LiveClass::where('status','Started')->latest()->paginate(10);

        return view('frontend.class',compact('classes'));
    }

    public function recordClass()
    {
        $classes = RecordClass::where('status','Active')->latest()->paginate(10);

        return view('frontend.record-class',compact('classes'));
    }

    public function profileUpdate( Request $request)
    {
        $user = auth()->user();

        // Validate Input
        $request->validate([
            'nickname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Verify the password
        if($request->old_password != null){
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'The password you entered is incorrect.']);
            }
    
            if ($request->password != $request->confirm_password) {
                return back()->withErrors(['password' => 'The confirm password doesnot match']);
            }

            $user->password = Hash::make($request->password);
            $user->user_password = $request->password;
        }
        

        // Update Profile
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

}