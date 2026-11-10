<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JWTAuth;
use App\Http\Controllers\Auth\CustomUser;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\Region;
use App\Models\Location;
use App\Models\EmailConfig;
use App\Models\SubCategory;
use App\Models\ServiceInfo;
use App\Models\NewEnquiry;
use App\Mail\SendEmail;
use Mail;
use DB;
use File;
use Carbon\Carbon;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $debugFlag = 1;

    public function generateJWT($user)
    {
        $encryption_key = env('APP_KEY');
        $time = time();
        $current_user = new CustomUser($user, $time);
        $token = JWTAuth::fromUser($current_user);
        return $token;
    }

    public function replaceMailContent($mailData){
        $mailData['title'] = str_replace('[TICKET_ID]', $mailData['ticketID'], $mailData['title']);
        $mailData['body'] = str_replace('[USER_NAME]', $mailData['userName'], $mailData['body']);
        $mailData['body'] = str_replace('[USER_EMAIL]', $mailData['userEmail'], $mailData['body']);
        $mailData['body'] = str_replace('[STATUS]', $mailData['status'], $mailData['body']);
        $mailData['body'] = str_replace('[REMARKS]', $mailData['remarks'], $mailData['body']);
        $mailData['body'] = str_replace('[TICKET_ID]', $mailData['ticketID'], $mailData['body']);
        $mailData['body'] = str_replace('[PRODUCT_NAME]', $mailData['productName'], $mailData['body']);
        $mailData['body'] = str_replace('[REGION_NAME]', $mailData['regionName'], $mailData['body']);
        $mailData['body'] = str_replace('[LOCATION_NAME]', $mailData['locationName'], $mailData['body']);
        $mailData['body'] = str_replace('[ISSUE_DESCRIPTION]', $mailData['issueDescription'], $mailData['body']);
        $mailData['body'] = str_replace('[TIMESTAMP]', $mailData['timeStamp'], $mailData['body']);
        $mailData['body'] = str_replace('[CLIENT_NAME]', $mailData['clientName'], $mailData['body']);

        // if($mailData['productName'] == 'Others'){
        //     $mailData['title'] = str_replace('for Others','',$mailData['title']);
        //     $mailData['body'] = str_replace('for Others','', $mailData['body']);
        // }

        return $mailData;
    }

    public function statusUpdateEmailAdmin($regionId , $loctionId, $mailInfo){

        $regionEmailString = Region::select('email')->where('id', $regionId)->first();
        $locationEmailString = Location::select('email')->where('id', $loctionId)->first();

        $regionEmails = @explode(',', $regionEmailString->email) ?? [] ;
        $locationEmails = @explode(',', $locationEmailString->email) ?? [];
        $emailArray = array_merge($regionEmails, $locationEmails);
        $emailArray = array_unique($emailArray);
        $emailArray = array_values($emailArray);
        // dd($emailArray);
        // echo '<pre>';
        // var_dump($emailArray);
        if(count($emailArray) !=0){
            $mailContent = EmailConfig::where('templateID','STATUS_UPDATE_EMAIL_ADMIN')->first();
            $mailData = [
                'title' => $mailContent->subject,
                'body' => $mailContent->body,
                "userName" => $mailInfo['userName'],
                'userEmail' => $mailInfo['userEmail'],
                'status' =>$mailInfo['status'],
                'remarks' => $mailInfo['remarks'],
                'ticketID' => (string)$mailInfo['ticketID'],
                'regionName' => $mailInfo['regionName'],
                "locationName" => $mailInfo['locationName'],
                'issueDescription' => $mailInfo['issueDescription'],
                "timeStamp" => $mailInfo['updatedAt'],
                "productName" => $mailInfo['productName'],
                'clientName' => $mailInfo['clientName']
            ];
            $mailData = $this->replaceMailContent($mailData);
            // dd($mailData);
            foreach($emailArray as $key=> $email){
                if(!empty($email)){
                    Mail::to($email)->send(new SendEmail($mailData));
                }
            }
        }

    }

    public function statusUpdateEmailUser($id,$mailInfo ,$type){
        $email =null;
        if($type == 'serviceInfo'){
            $email = ServiceInfo::select('email')->where('id', $id)->first();
        }else{
            $email = NewEnquiry::select('email')->where('id', $id)->first();
        }
        $mailContent = EmailConfig::where('templateID','STATUS_UPDATE_EMAIL_USER')->first();
        $mailData = [
            'title' => $mailContent->subject,
            'body' => $mailContent->body,
            "userName" => $mailInfo['userName'],
            'userEmail' => $mailInfo['userEmail'],
            'status' =>$mailInfo['status'],
            'remarks' => $mailInfo['remarks'],
            'ticketID' => (string)$mailInfo['ticketID'],
            'regionName' => $mailInfo['regionName'],
            "locationName" => $mailInfo['locationName'],
            'issueDescription' => $mailInfo['issueDescription'],
            "timeStamp" => $mailInfo['updatedAt'],
            "productName" => $mailInfo['productName'],
            'clientName' => $mailInfo['clientName']
        ];
        $mailData = $this->replaceMailContent($mailData);
        // dd($mailData);
        if($email->email != null){
            Mail::to($email->email)->send(new SendEmail($mailData));
        }
    }

    public function getSubcategory(){
        $subCategories = SubCategory::select('id', 'subcategoryName')->get();
        return $subCategories;
    }

    public function getRegion(){
        $regions = Region::select('id','regionID', 'regionTag')->get();
        return $regions;
    }

    protected function gen_secret()
    {
        $length = 512;
        $val = '';
        for ($i = 0; $i < $length; $i++) {
            $val .= rand(0, 9);
        }
        $fp = fopen('/dev/urandom', 'rb');
        $val = fread($fp, 32);
        fclose($fp);
        $val .= uniqid(mt_rand(), true);
        $hash = hash('sha512', $val, true);
        $result = rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');
        return $result;
    }

    protected function send_mail($content, $subject, $to)
    {
        // return $to;
        // try {
        //     $from_email = env('MAIL_FROM_ADDRESS');
        //     $from_name = env('MAIL_FROM_NAME');
        //     $mail = Mail::send($template, $data_message, function($messages) use ($to, $subject, $from_email, $from_name){
        //         $messages->to($to)
        //             ->from($from_email, $from_name)
        //             ->subject($subject);
        //     });
        //     $return =array(
        //         "data" => $mail,
        //         "message" => 'Mail sent successfully!!!',
        //         'status' => "success"
        //     );
        // } catch(\Exception $e){
        //     $return =array(
        //         "data" => "",
        //         "message" => $e->getMessage(),
        //         'status' => "error"
        //     );
        // }
        // return response()->json($return);
        try {
            $name = env('APP_NAME');
            $from_email = env("MAIL_FROM_ADDRESS");
            $from_name = env('APP_NAME');
          
            Mail::html($content, function($message) use ($to, $subject, $from_email, $from_name) {
                $message->to($to)
                    ->from($from_email, $from_name)
                    ->subject($subject);
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    protected function send_sms($phone, $message)
    {
        try {
            $body = [
                'key' => 'b2177aadb4678c10f395c0a75691428e',
                'route' => 2,
                'sender' => 'AQMS',
                'number' => $phone,
                'sms' => $content,
                'templateid' => $template_id,
            ];
            $apiUrl = 'http://site.ping4sms.com/api/smsapi';
            $apiResponse = Http::post($apiUrl, $body);
            $apiBody = "";
            if ($apiResponse->successful()) {
                $apiBody = json_decode($apiResponse->body());
            }
            $return =array(
                "data" => $apiBody,
                "message" => 'Mail sent successfully!!!',
                'status' => "success"
            );
        } catch(\Exception $e){
            $return =array(
                "data" => "",
                "message" => $e->getMessage(),
                'status' => "error"
            );
        }
        return response()->json($return);
    }

    protected function send_otp($phone, $user_id)
    {
        try {
            $code = rand(1000, 9999);
            $exist = DB::table('user_otp')->where('user_id', '=', $user_id)->first();
            $data1 = array(
                'user_id' => $user_id,
                'code' => $code
            );
            if ($exist) {
                $data1['updated_at'] = date('Y-m-d h:i:s');
                DB::table('user_otp')->where('user_id', '=', $user_id)->update($data1);
            } else {
                $data1['created_at'] = date('Y-m-d h:i:s');
                DB::table('user_otp')->insert($data1);
            }
            $message = "2FA login code is ". $code;
            $sms = [];
            // $sms = $this->send_sms($phone, $message);
            $return =array(
                "data" => $sms,
                "message" => 'SMS sent successfully!!!',
                'status' => "success"
            );
        } catch(\Exception $e){
            $return =array(
                "data" => "",
                "message" => $e->getMessage(),
                'status' => "error"
            );
        }
        return $return;
    }




}
