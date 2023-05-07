<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Model\Otp;
use App\Model\Customer;
use App\Mail\RequestOTP;
use App\Traits\SendSMSTrait;
use Illuminate\Http\Request;
use App\Helpers\CustomerAuth;
use App\Mail\FrontendRequestOTP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    use SendSMSTrait;

    public function loginForm()
    {
        return view('frontend.auth.login');
    }

    public function requestOTPForm(Request $request)
    {
        $for = $request->for;
        return view('frontend.Otp.request-otp',compact('for'));
    }



    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,username',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $requestData = $request->only('name', 'email', 'password');
        $requestData['username'] = $request->email;
        $requestData['password'] = Hash::make($requestData['password']);

        try {
            $customer = Customer::create($requestData);
            CustomerAuth::login($customer);

            return redirect()->route('frontend.home')->with('success', 'Successfully register account!');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:customers,username',
            'password' => 'required',
        ]);

        $customer = Customer::where('username', $request->email)->get()->first();
        if (!in_array($customer->status,[0,1])) {
            return redirect()->back()->with('error',"The Username $request->email is not found");
        }
        if (!Hash::check($request->password, $customer->password)) {
            return redirect()->back()
                        ->withInput($request->input())
                        ->with('error', 'The password you entered is incorrect!');
        }

        CustomerAuth::login($customer);
        if ($request->redirect) {
            return redirect($request->redirect)->with('success', 'Successfully login to your account!');
        }
        return redirect()->route('frontend.home')->with('success', 'Successfully login to your account!');
    }

    public function logout()
    {
        $customer = Customer::find(session('customerId'));

        if (!$customer) {
            return redirect()->route('frontend.loginForm')->with('error', 'Something want wrong!');
        }

        CustomerAuth::logout();
        return redirect()->route('frontend.home')->with('success', 'Successfully logout from your account!');
    }

    public function requestOTP(Request $request){
        $for = $request->for;
        $rules = [
            'username' => 'required||unique:customers,username',
        ];
        if ($for) {
            $rules = [
                'username' => 'required',
            ];
        }
        $request->validate($rules);

        $user = Customer::where('username',$request->username)->first();

        if (!$user && $for) {
            return redirect()->back()->with('error','This username is not registered!');
        }

        $data['username'] = $request->username;
        $data['code'] = rand(1000, 9999);

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            //Send OTP by Mail
            Mail::to($request->username)->send(new RequestOTP($data['code']));
        } else {
            $data['code'] = rand(1000, 9999);
            $msg = 'Your OTP verification code is : '. $data['code'];
            //Send OTP by SMS
            $result = $this->sendBySMSPoh($request->username, $msg);
            $resultArr = json_decode($result, true);

            if (!$resultArr['status']) {
                return redirect()->back()->with('error','Something went wrong while sending sms');
            }
        }
        $Otp = Otp::create([
            'username'=>$request->username,
            'code'=>$data['code']
        ]);
        $otp_id = $Otp->id;
        return view('frontend.Otp.verify-otp',compact('for','otp_id'));
    }

    public function verifyOTP(Request $request){
        $code = $request->code_1.$request->code_2.$request->code_3.$request->code_4;
        $Otp = Otp::where('username',$request->username)->orderBy('id','desc')->first();
        if($Otp->code <> $code){
            return redirect()->back()->with('error','Invalid OTP code!');
        }
        $Otp->update([
            'status' => false
        ]);

        if ($request->for) {
            return view('frontend.auth.reset-password',['otp'=>$Otp]);
        }
        return view('frontend.auth.register',['otp'=>$Otp]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password'
        ]);

        Customer::where('username',$request->username)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return to_route('frontend.login')->with('success','Password successfully changed!');
    }
}
