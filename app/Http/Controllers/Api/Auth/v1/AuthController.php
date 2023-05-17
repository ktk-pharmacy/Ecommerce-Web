<?php

namespace App\Http\Controllers\Api\Auth\v1;

use App\Http\Controllers\Controller;
use App\Mail\RequestOTP;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Otp;
use App\Traits\SendSMSTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use SendSMSTrait;

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|string',
        ];

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $rules['username'] = 'required|email|exists:customers,username';
        } else {
            $rules['username'] = 'required|exists:customers,username';
        }

        $request->validate($rules);

        $customer = Customer::withCount(['orders' => function ($q) {
            $q->where('status', 'Completed')->whereNotNull('coupon_id');
        }])->where('username', $request->username)->first();

        if (!$customer || ! Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if (!$customer->status) {
            return response()->error("Your account has been deactivated.", 401, ['usernmae' => 'Invalid user!']);
        }

        // if (!$customer->verified_at) {
        //     return response()->error("Please verify your account!", 403, ['username' => 'Not verified!']);
        // }

        $data['access_token'] =  $customer->createToken('528TOKEN')->plainTextToken;
        $data['customer'] = $customer;

        return response()->success('Login Success!', 200, $data);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ];

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $rules['username'] = 'required|email|unique:customers,username';
        } else {
            $rules['username'] = 'required|unique:customers,username';
        }

        $request->validate($rules);

        $requestData = $request->only('name', 'username', 'email', 'contact_phone_no', 'password');
        $requestData['password'] = Hash::make($requestData['password']);

        try {
            $customer = Customer::create($requestData);
            $data['access_token'] =  $customer->createToken('528TOKEN')->plainTextToken;
            $data['customer'] = $customer;

            return response()->success('Successfully register account!', 200, $data);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->success('Successfully logout!', 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password'
        ]);

        $customer = $request->user();

        if (asset($customer)) {
            $customer->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->success('Password successfully updated!', 200, $customer);
        }

        return response()->error('User does not exit!', 404);
    }

    public function requestOTP(Request $request)
    {
        $rules = [
            'username' => 'required',
        ];

        if ($request->for == 'forget-password') {
            $rules['username'] = 'required|exists:customers,username';
        }

        $request->validate($rules);

        $data['username'] = $request->username;
        $data['code'] = rand(1000, 9999);

        try {
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
                    return response()->success('Something went wrong while sending sms', 500, $resultArr);
                }
            }

            $Otp = new Otp();
            $Otp->username = $request->username;
            $Otp->code = $data['code'];
            $Otp->save();

            return response()->success('Successfully send OTP code to your ' . $data['username'], 200);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function validationOTP(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'code' => 'required|numeric|digits:4'
        ]);

        try {
            $requestData = $request->only('username', 'code');
            $requestData['status'] = true;

            $otp = Otp::where($requestData)->firstOrFail();
            $otp->update([
                'status' => false
            ]);

            $data = null;

            if ($request->for == 'forget-password') {
                $customer = Customer::where('username', $request->username)->firstOrFail();
                $data['access_token'] =  $customer->createToken('528TOKEN')->plainTextToken;
            }


            return response()->success('Success', 200, $data);
        } catch (\Throwable $th) {
            return response()->error('Invalid OTP code!', 400, ['code' => ['Invalid OTP code!']]);
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'gender' => 'required',
            'contact_phone_no' => 'required',
            'billing_address' => 'required',
            'shipping_address' => 'required',
        ]);

        try {
            $requestData = $request->all();

            if ($request->hasFile('profile_image')) {
                $path = Customer::UPLOAD_PATH . "/" . date("Y") . "/" . date("m") . "/";
                if (!is_dir($path)) {
                    mkdir($path, 0775, true);
                    file_put_contents($path . "/index.html", "");
                }

                $fileName = uniqid().time().'.'.$request->profile_image->extension();
                $request->profile_image->move(public_path($path), $fileName);
                $requestData['profile_image'] = $path . $fileName;
            }

            $customer = $request->user();
            $customer->update($requestData);

            return response()->success('Success', 200, $customer);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function getProfile(Request $request)
    {
        $customer = $request->user()->loadCount(['orders' => function ($q) {
            return $q->where('status', 'Completed')->whereNotNull('coupon_id');
        }]);

        return response()->success('Success', 200, $customer);
    }

    public function deactivate(Request $request)
    {
        $customer = $request->user();

        $customer->update([
            'status' => false
        ]);
        $customer->currentAccessToken()->delete();

        return response()->success('Success', 200, $customer);
    }
}
