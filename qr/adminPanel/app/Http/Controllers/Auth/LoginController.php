<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\EmailConfig;
use App\Models\User;
use Auth;
use DB;
use Session;
use Hash;
use Exception;
use Mail;
use Carbon\Carbon;
use App\Mail\ResetPassword;

class LoginController extends Controller
{

    public function loginView(){
        return view('auth.cover-login');
    }

    public function recoverView(){
        return view('auth.cover-password-reset');
    }

    public function register(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|min:8|string',
            ];
            $validate = Validator::make($request->all(), $rules);
            if($validate->fails()){
                $data['status'] = 'error';
                $data['message'] = $validate->errors();
                $return = new Response($data);
                $return->setStatusCode(422);
            } else {
                $exisiting_email = User::where('email', $request->email)->count();
                if($exisiting_email){
                    $data['status'] = 'error';
                    $data['message']['user'] = 'User with the email already exists';
                    $return = new Response($data);
                    $return->setStatusCode(409);
                } else {
                    $new_user = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ];
                    // return $new_user;
                    $new_user_id = User::create($new_user);
                    if($new_user_id){
                        /*
                            if($request->first_name){
                                $email_data['name'] = $request->first_name;
                            } else {
                                $email_data['name'] = explode('@', $request->email)[0];
                            }
                            // $email_data['app_name'] = env('APP_NAME');
                            if($request->server('HTTP_REFERER')){
                                $email_data['app_name'] = explode('.', explode('/', $request->server('HTTP_REFERER'))[2])[0];
                                $email_data['login_url'] = $request->server('HTTP_ORIGIN');
                                $email_data['error_message'] = '';
                            } else {
                                $email_data['app_name'] = env('APP_NAME');
                                $email_data['login_url'] = 'javascript:void(0)';
                                $email_data['error_message'] = 'Unable to generate URL on test';
                            }

                            $title = 'Welcome to '.$email_data['app_name'];

                            $htmlContent = env('NEW_USER_EMAIL');
                            $htmlContent = str_replace('{{ $Email_name }}', $email_data['name'], $htmlContent);
                            $htmlContent = str_replace('{{ $Email_app_name }}', $email_data['app_name'], $htmlContent);
                            $htmlContent = str_replace('{{ $Email_error_message }}', $email_data['error_message'], $htmlContent);
                            $htmlContent = str_replace('{{ $Email_login_url }}', $email_data['login_url'], $htmlContent);

                            $this->send_mail_env('emails.new_user', $email_data, $title, $request->email, 1, $htmlContent);
                        */

                        $data['status'] = 'success';
                        $data['message'] = 'User created successfully';
                        $return = new Response($data);
                        $return->setStatusCode(201);
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = 'Unable to  create user';
                        $return = new Response($data);
                        $return->setStatusCode(500);
                    }
                }
            }
        } else {
            $data['message'] = 'Request method not allowed';
            $data['status'] = 'error';
            $return = new Response($data);
            $return->setStatusCode(405);
        }

        return $return;

    }

    public function login(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = [
                'email' => 'required|email',
                'password' => 'required|string'
            ];
            $validate = Validator::make($request->all(), $rules);
            if($validate->fails()){
                $data['status'] = 'error';
                $data['message'] = $validate->errors();

                $return = new Response($data);
                $return->setStatusCode(422);
            } else {
                $email = $request->email;
                $password = $request->password;
                $credentials = [
                    "email" => $email,
                    "password" => $password,
                    "isVerified" => 1
                ];

                try {
                    $user = DB::table('users')->where('email', '=', $email)->first();

                    if($user){
                        if($user->blocked){
                            $return = new Response([
                                "status" => "error",
                                "message" => "User is blocked, please contact admin"
                            ]);
                            $return->setStatusCode(403);
                        } else {
                            $islogin =  Auth::attempt($credentials);
                            if($islogin){
                                $userLogData = [
                                    'userId' => $user->id,
                                    'userEmail' => $user->email,
                                    'action' =>  "LoggedIn"
                                ];
                                DB::table('userLogs')->insert($userLogData);
                                // $twofa_status = $user_details->twofa_status;
                                // if($twofa_status == 1 && $request->tfa != "verified" ){
                                //     $status = $this->send_otp($user_details->phone, $user_details->id);
                                //     if($status['status'] == 'success'){
                                //         $data['status'] = 'success';
                                //         $data['twoFA'] = true;
                                //         $data['user_id'] = $user_details->id;
                                //         $data['message'] = $status['message'];
                                //         $return = new Response($data);
                                //         $return->setStatusCode(200);
                                //     } else {
                                //         $data['status'] = 'error';
                                //         $data['message']['user'] = 'Unable to send OTP';
                                //         $return = new Response($data);
                                //         $return->setStatusCode(500);
                                //     }
                                // } else {
                                    // $customers = DB::table('customers')->where('customerId', $user->companyCode)->first();
                                    $company = DB::table('users')->where('id', $user->id)->first();
                                    Session::put('USER_ID', $user->id);
                                    Session::put('USER_ROLE', $user->userRole);
                                    // dd($user->userRole);
                                    $token = $this->generateJWT($user);
                                    $return = new Response([
                                        "accessToken" => $token,
                                        "status" => "success",
                                        "message" => "Successfully logged in",
                                        "twoFA" => false,
                                        "debug" => 1,
                                        "userDetails" => [
                                            "firstName" => $user->firstName,
                                            "lastName" => $user->lastName,
                                            "email" => $user->email,
                                            'role' => $user->userRole,
                                            'id' => $user->id,
                                            'employeeID' => $user->employeeID,
                                            'imageInfo' => $user->imageInfo,
                                            "pin" => $user->pin,
                                            // "employeeID" => $user->employeeID,
                                            // "companyCode" => $user->companyCode,
                                            // "companyName" => $company->companyName,
                                            // "locationID" => $user->locationID,
                                            // "branchID" => $user->branchID,
                                            // "facilityID" => $user->facilityID,
                                            // "buildingID" => $user->buildingID,
                                            // "floorID" => $user->floorID,
                                            // "zoneID" => $user->zoneID,
                                            // "defaultImageInfo" => $company->imageInfo,
                                            // "imageInfo" => $user->imageInfo,
                                            // "allData" => $allData
                                        ]
                                    ]);
                                    $return->setStatusCode(200);
                                // }
                            } else {
                                $return = new Response([
                                    'status' => 'error',
                                    'message' => 'Email or password is incorrect'
                                ]);
                                $return->setStatusCode(401);
                            }
                        }
                    } else {
                        $data['message'] = 'User not found';
                        $data['status'] = 'error';
                        $return = new Response($data);
                        $return->setStatusCode(404);
                    }

                } catch(\Exception $e){
                    $return = new Response([
                        "message" => $e->getMessage(),
                        'status' => "error"
                    ]);
                    $return->setStatusCode(500);
                }
            }
        } else {
            $data['message'] = 'Request method not allowed';
            $data['status'] = 'error';
            $return = new Response($data);
            $return->setStatusCode(405);
        }
        return $return;
    }

    public function otp_login_verify(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = [
                'otp' => 'required|string'
            ];
            $validate = Validator::make($request->all(), $rules);
            if($validate->fails()){
                $data['status'] = 'error';
                $data['message'] = $validate->errors();
                $return = new Response($data);
                $return->setStatusCode(422);
            } else {
                $user_id = $request->user_id;
                $otp = $request->otp;
                $check_otp = DB::table('user_otp')->where('user_id', '=', $user_id)->where('code', '=', $otp)->first();
                if($check_otp){
                    $user = DB::table('users')
                        ->where('id', '=', $user_id)
                        ->where('isVerified', '=', '1');
                    if($user->first()){
                        // return $credentials;
                        try {
                            $islogin =  Auth::loginUsingId($user->first()->id);
                            // return $islogin;
                            if($islogin){
                                $token = $this->generateJWT($user->first());
                                $data['status'] = 'success';
                                $data['message']['user'] = 'Login successful';
                                $data['twoFA'] = false;
                                $data['access_token'] = $token;
                                $return = new Response($data);
                                $return->setStatusCode(200);
                            } else {
                                $data['status'] = 'error';
                                $data['message']['user'] = 'Email or password is incorrect';
                                $return = new Response($data);
                                $return->setStatusCode(401);
                            }
                        } catch(\Exception $e){
                            $return =array(
                                "data" => "",
                                "message" => $e->getMessage(),
                                'status' => "error"
                            );
                        }
                    } else {
                        $data['message']['user'] = 'User not found';
                        $data['status'] = 'error';
                        $return = new Response($data);
                        $return->setStatusCode(404);
                    }
                }else{
                    $data['message']['user'] = 'Invalid OTP';
                    $data['status'] = 'error';
                    $return = new Response($data);
                    $return->setStatusCode(404);
                }
            }
        } else {
            $data['message'] = 'Request method not allowed';
            $data['status'] = 'error';
            $return = new Response($data);
            $return->setStatusCode(405);
        }
        return $return;
    }

    public function forgot_password(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = [
                'email' => 'required|email'
            ];
            $validate = Validator::make($request->all(), $rules);
            if($validate->fails()){
                $data['status'] = 'error';
                $data['message'] = $validate->errors();
                $return = new Response($data);
                $return->setStatusCode(422);
            } else {
                $email = $request->email;
                $user = User::where('email', $email)
                            ->where('isVerified', 1)
                            ->first();
                if($user){
                    $data['password'] = $this->gen_secret();
                    User::where('id', '=', $user->id)->update($data);

                    $url = $request->server('HTTP_ORIGIN').'/'.'reset-password/'.$data['password'];
                    // $data2['message_data'] = trans('noshform.password_reset1') . '<br>';
                    // $data2['message_data'] .= trans('noshform.password_reset2') . ':<br>';
                    // $data2['message_data'] .= '<a href="'.$url.'" >'.$url.'</a>';

                    $htmlContent = env('FORGOT_PASSWORD_EMAIL');
                    $htmlContent = str_replace('{{ $Email_url }}', $url, $htmlContent);

                    $app_name = env('APP_NAME');
                    $mail_data = array('token' => $data['password']);

                    $mail = $this->send_mail('emails.auth.forget', $mail_data, 'Reset password to '.$app_name, $request->email);
                    // $this->send_mail('auth.emails.generic', $data2, 'Reset password to Simplenote', $request->input('email'), 1);
                    // $message = trans('noshform.password_reset4');

                    $return['data'] = $mail;
                    $return['status'] = 'success';
                    $return['message'] = 'Mail sent successfully';
                    $return = new Response($return);
                    $return->setStatusCode(200);
                } else {
                    $data['status'] = 'error';
                    $data['message'] = 'User with the email not found.';
                    $return = new Response($data);
                    $return->setStatusCode(404);
                }
            }
        } else {
            $data['message'] = 'Request method not allowed';
            $data['status'] = 'error';
            $return = new Response($data);
            $return->setStatusCode(405);
        }
        return $return;

    }

    public function reset_password(Request $request, $token="")
    {
        $id = $token;
        // dd($token);

        if($id){
            $user = User::where('password', $id);
            if($user->first()){
                $rules = [
                    'password' => 'required|min:8'
                ];
                $validate = Validator::make($request->all(), $rules);
                if($validate->fails()){
                    $data['status'] = 'error';
                    $data['message'] = $validate->errors();
                    $return = new Response($data);
                    $return->setStatusCode(400);
                } else {
                    $email = $user->first()->email;
                    $password = substr_replace(Hash::make($request->password),"$2a",0,3);
                    $user->update([
                        'password' => $password
                    ]);
                    /*
                    $email_data['name'] = explode('@', $email)[0];
                    $email_data['app_name'] = $request->server('HTTP_REFERER') ? explode('.', explode('/', $request->server('HTTP_REFERER'))[2])[0] : env('APP_NAME');
                    $htmlContent = env('PASSWORD_RESET_SUCCESS');
                    $htmlContent = str_replace('{{ $Email_name }}', $email_data['name'], $htmlContent);
                    $htmlContent = str_replace('{{ $Email_app_name }}', $email_data['app_name'], $htmlContent);
                    $this->send_mail_env('auth.auth.password_reset_success', $email_data, 'Successfull password reset', $email, 1, $htmlContent);

                    // $send_mail = $this->send_mail('emails.auth.password_reset_success', $email_data, 'Successfull password reset', $email, 1);
                    */

                    $return['status'] = 'success';
                    $return['message'] = 'Password reset successful';

                    $return = new Response($return);
                    $return->setStatusCode(200);
                }

            } else {
                $return['status'] = 'error';
                $return['message'] = "Invalid request";
                $return = new Response($return);
                $return->setStatusCode(404);
            }

        } else {
            $data['status'] = 'error';
            $data['message'] = 'reset token is required';

            $return = new Response($data);
            $return->setStatusCode(422);
        }

        return $return;
    }


    public function logout(Request $request){
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        $return['status'] = "success";
        $return['message'] = "You have logged out.";
        
        return response()->json($return);

    }

    public function resetPassword (Request $request, $token){
        return view('auth.cover-password-update', compact('token'));
    }

    public function sendResetPasswordMail(Request $request){
        $validated = $request->validate([
            "email" => 'required|email'
        ]);

        $userEmail = User::where('email', $validated['email'])->first();

        if(!$userEmail){
            Session::flash('error', 'Email not found');
            return redirect('/');
        }else{

            $token = Str::random(64);
            DB::table('password_resets')->insert([
                "email" => $validated['email'],
                "token" => $token,
                "created_at" => Carbon::now()
            ]);

            $mailContent = EmailConfig::where('templateID','PASSWORD_RESET')->first();
            $userName = User::select('firstName','lastName')->where('email',$validated['email'])->first();
            $mailData = [
                'supportEmail' => env('SUPPORT_EMAIL'),
                'userName' => ($userName->firstName ?? '') . ' ' . ($userName->lastName ?? ''),
                'title' => $mailContent->subject,
                'body' => $mailContent->body,
                'token' => $token,
            ];

            // dd($mailData);

            Mail::to($validated['email'])->send(new ResetPassword($mailData));

            return back()->with('success', 'Check your mail for reset link');
        }
    }

    public function resetUserPassword(Request $request){
        
        $validated = $request->validate([
            'email' => "required|email",
            "password" => "required|confirmed",
            "password_confirmation" => "required"
        ]);
    
        $passwordResetRequest = DB::table('password_resets')->where('email', $validated['email'])->where('token', $request->token)->first();

        if(!$passwordResetRequest){
            return back()->with('error', 'Invalid Token');
        }

        User::where('email', $validated['email'])->update(["password" => Hash::make($validated['password'])]);

        DB::table('password_resets')->where('email', $validated['email'])->delete();

        return redirect()->route('loginView')->with('success','Password Updated');
    }

}
