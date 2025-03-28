<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Modual;
use GuzzleHttp\Client;
use App\Mail\DynamicMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Facades\UtilityFacades;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;

class FrontendController extends Controller
{

    public function index()
    {
        return view('index');
    }


    public function UserStatusChange()
    {
        $users = User::where('status','active')->get();
        foreach ($users as $user) {
            $user->status = 'expired';
            $user->save();
        }


        $users = User::where('status','upcoming')->get();
        foreach ($users as $user) {
            $user->status = 'active';
            $user->save();
        }

        echo 'Success';
    }
    
    public function thanks()
    {
        $user = Auth::user();
        return view('thanks',compact('user'));
    }

    public function sendEmails()
    {

        $user = User::latest()->first();

        $welcomeData = [
            'subject' => 'Payment Complete and Login Details',
            'title' => 'Your Payment Complete here Login Details',
            'message' => 'Thank you for joining our platform.',
            'user' => $user,
        ];

        Mail::to($user->email)->send(new DynamicMail($welcomeData, 'emails.reminder'));
    }

    

    protected function userRegister(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required',  'max:255', 'unique:users'],
            'whatsapp' => ['required',  'max:255'],
        ]);

        $registerDate = Carbon::now(); 
        $currentMonth = $registerDate->month;

        if ($registerDate->month === $currentMonth) {
            if ($registerDate->day >= 1 && $registerDate->day <= 23) {
                $status = 'active';
            } elseif ($registerDate->day >= 24 && $registerDate->day <= 27) {
                $status = 'upcoming';
            } else {
                $status = 'active';
            }
        } else {
            $status = 'active'; 
        }

        $user = new User();

        // Generate a random password (or use the actual password)
        $password = Str::random(10);

        $user->nickname = $request->name;
        $user->name = $request->name;
        $user->user_password = $password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->whatsapp = $request->whatsapp;
        $user->status = $status;
        $user->type = 'user';
        $user->password = Hash::make($password);
        $user->save();

        // Log in the user
        Auth::login($user);

         // Redirect to the payment page with the user ID and amount
         return redirect()->route('bkash.create', [
            'user_id' => $user->id,
            'amount' => get_option('bootcamp_price'),
        ]);

    }

    public function chart(Request $request)
    {

        if ($request->type == 'year') {

            $arrLable = [];
            $arrValue = [];

            for ($i = 0; $i < 12; $i++) {
                $arrLable[] = Carbon::now()->subMonth($i)->format('F');
                $arrValue[Carbon::now()->subMonth($i)->format('M')] = 0;
            }
            $arrLable = array_reverse($arrLable);
            $arrValue = array_reverse($arrValue);

            $t = User::select(DB::raw('DATE_FORMAT(created_at,"%b") AS user_month,COUNT(id) AS usr_cnt'))
                ->where('created_at', '>=', Carbon::now()->subDays(365)->toDateString())
                ->where('created_at', '<=', Carbon::now()->toDateString())
                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%b") '))
                ->get()
                ->pluck('usr_cnt', 'user_month')
                ->toArray();

            foreach ($t as $key => $val) {
                $arrValue[$key] = $val;
            }
            $arrValue = array_values($arrValue);
            return response()->json(['lable' => $arrLable, 'value' => $arrValue], 200);
        }

        if ($request->type == 'month') {

            $arrLable = [];
            $arrValue = [];

            for ($i = 0; $i < 30; $i++) {
                $arrLable[] = date("d M", strtotime('-' . $i . ' days'));

                $arrValue[date("d-m", strtotime('-' . $i . ' days'))] = 0;
            }
            $arrLable = array_reverse($arrLable);
            $arrValue = array_reverse($arrValue);

            $t = User::select(DB::raw('DATE_FORMAT(created_at,"%d-%m") AS user_month,COUNT(id) AS usr_cnt'))
                ->where('created_at', '>=', Carbon::now()->subDays(365)->toDateString())
                ->where('created_at', '<=', Carbon::now()->toDateString())
                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%d-%m") '))
                ->get()
                ->pluck('usr_cnt', 'user_month')
                ->toArray();

            foreach ($t as $key => $val) {
                $arrValue[$key] = $val;
            }
            $arrValue = array_values($arrValue);

            return response()->json(['lable' => $arrLable, 'value' => $arrValue], 200);
        }
    }
}
