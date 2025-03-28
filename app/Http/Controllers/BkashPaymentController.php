<?php 

namespace App\Http\Controllers;

use Log;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Mail\DynamicMail;
use App\Models\Cources;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BkashPaymentController extends Controller
{
    private $base_url;

    public function __construct()
    {
        // Sandbox
        $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        // Live
        
    }

    public function authHeaders(){
        return array(
            'Content-Type:application/json',
            'Authorization:' .$this->grant(),
            'X-APP-Key:'.env('BKASH_CHECKOUT_URL_APP_KEY')
        );
    }
         
    public function curlWithBody($url,$header,$method,$body_data_json){
        $curl = curl_init($this->base_url.$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function grant()
    {
        $header = array(
                'Content-Type:application/json',
                'username:'.env('BKASH_CHECKOUT_URL_USER_NAME'),
                'password:'.env('BKASH_CHECKOUT_URL_PASSWORD')
                );
        $header_data_json=json_encode($header);

        $body_data = array('app_key'=> env('BKASH_CHECKOUT_URL_APP_KEY'), 'app_secret'=>env('BKASH_CHECKOUT_URL_APP_SECRET'));
        $body_data_json=json_encode($body_data);
    
        $response = $this->curlWithBody('/tokenized/checkout/token/grant',$header,'POST',$body_data_json);

        $token = json_decode($response)->id_token;
        return $token;
    }

    // Show the payment page
    public function index(Request $request)
    {
        // Retrieve data passed during the redirect
        $user_id = $request->get('user_id');
        $amount = $request->get('amount');

        // Pass the data to the view
        return view('payment', compact('user_id', 'amount'));
    }

    // Create payment
    public function create(Request $request)
    {

        $user_id = $request->get('user_id');
        $amount = $request->get('amount');

        $route = route('url-callback');

        $header =$this->authHeaders();

        $website_url = URL::to("/");

        $orderId = strtoupper(Str::random(10));

        $amount = $request->amount;

        $body_data = array(
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => $route,
            'amount' => $amount ? $amount : 10,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $orderId // you can pass here OrderID 
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create',$header,'POST',$body_data_json);
        return redirect((json_decode($response)->bkashURL));
        
    }


    public function executePayment($paymentID)
    {
        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/execute',$header,'POST',$body_data_json);

        $res_array = json_decode($response,true);

        if(isset($res_array['trxID'])){

            $bankID = $res_array['trxID'];
            $tran_date = $res_array['paymentExecuteTime'];
            $tran_id = $res_array['merchantInvoiceNumber'];
            $card_issuer = $res_array['customerMsisdn'];
            $amount = $res_array['amount'];

            $user = Auth::user();
            $user->payment_status = 1;
            $user->save();

            $course = Cources::latest()->first();
            // Create the order
            $order = Order::create([
                'order_id' => Order::generateOrderId(), 
                'user_id' => $user->id,
                'amount' => $amount,
                'course_id' => $course->id,
                'status' => 'Success', 
                'bank_tran_id' => $bankID,
                'card_issuer' => $card_issuer,
                'tran_date' => $tran_date,
                'details' => $response,
            ]);

            // Send mail 

            $welcomeData = [
                'subject' => 'Payment Complete and Login Details',
                'title' => 'Your Payment Complete here Login Details',
                'message' => 'Thank you for joining our platform.',
                'user' => $user,
            ];

            Mail::to($user->email)->send(new DynamicMail($welcomeData, 'emails.reminder'));
        
        }

        return $response;
    }



    public function callback(Request $request)
    {
        $allRequest = $request->all();

        if(isset($allRequest['status']) && $allRequest['status'] == 'failure'){
            Session::flush();
            Auth::logout();
            return redirect()->route('userhome')->with('error', 'Payment Failure');

        }else if(isset($allRequest['status']) && $allRequest['status'] == 'cancel'){
            Session::flush();
            Auth::logout();
            return redirect()->route('userhome')->with('error', 'Payment Cancell');
        }else{
            
            $response = $this->executePayment($allRequest['paymentID']);

            $arr = json_decode($response,true);
    
            if(array_key_exists("statusCode",$arr) && $arr['statusCode'] != '0000'){
                Session::flush();
                Auth::logout();
                $error = 'Payment FAILED '.$arr['statusMessage'];
                return redirect()->route('userhome')->with('error', $error);

            }else if(array_key_exists("message",$arr)){
                // if execute api failed to response
                sleep(1);
                $query = $this->queryPayment($allRequest['paymentID']);
                Session::flush();
                Auth::logout();
                return redirect()->route('thanks')->with('success', 'Payment Successfully');
            }
    
            Session::flush();
            Auth::logout();
            return redirect()->route('thanks')->with('success', 'Payment Successfully');

        }

    }



    public function queryPayment($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );
        $body_data_json=json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/payment/status',$header,'POST',$body_data_json);
        
        $res_array = json_decode($response,true);
        
        if(isset($res_array['trxID'])){

            $bankID = $res_array['trxID'];
            $tran_date = $res_array['paymentExecuteTime'];
            $tran_id = $res_array['merchantInvoiceNumber'];
            $card_issuer = $res_array['customerMsisdn'];
            $amount = $res_array['amount'];

            $user = Auth::user();
            $user->payment_status = 1;
            $user->save();

            $course = Cources::latest()->first();
            // Create the order
            $order = Order::create([
                'order_id' => Order::generateOrderId(), 
                'user_id' => $user->id,
                'amount' => $amount,
                'course_id' => $course->id,
                'status' => 'Success', 
                'bank_tran_id' => $bankID,
                'card_issuer' => $card_issuer,
                'tran_date' => $tran_date,
                'details' => $response,
            ]);

            // Send mail 

            $welcomeData = [
                'subject' => 'Payment Complete and Login Details',
                'title' => 'Your Payment Complete here Login Details',
                'message' => 'Thank you for joining our platform.',
                'user' => $user,
            ];

            Mail::to($user->email)->send(new DynamicMail($welcomeData, 'emails.reminder'));
        
        }

         return $response;
    }
}
