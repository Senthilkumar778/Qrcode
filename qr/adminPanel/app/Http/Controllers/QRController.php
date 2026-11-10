<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Location;
use App\Models\Region;
use App\Models\Product;
use App\Models\ServiceInfo;
use App\Models\ServiceInfoHistory;
use App\Models\NewEnquiryHistory;
use App\Models\NewEnquiry;
use App\Models\EmailConfig;
use Session;

class QRController extends Controller
{
    public function __construct(){
        date_default_timezone_set('asia/kolkata');
    }

    public function index()
    {
        $data['locations'] = Location::all();
        return view('qr.index', $data);
    }

    public function support_for(Request $request, $region)
    {
        $data['products'] = Product::all();
        return view('qr.support-for', $data);
    }

    public function new_enquiry(Request $request, $region)
    {
        $data['products'] = Product::all();
        return view('qr.new-enquiry', $data);
    }

    public function user_email($email, $type, $id, $data, $info_page, $userName)
    {
        if($type == "support"){
            $content = EmailConfig::where("templateID", "SERVICE_EMAIL_TO_USERS")->first();
        }

        if($type == "new"){
            $content = EmailConfig::where("templateID", "NEWENQUIRY_EMAIL_TO_USERS")->first();
        }

        $body = $content->body;
        $body = str_replace("[PRODUCT_TYPE]", $data->productName, $body);
        $body = str_replace("[INFO_PAGE]", $info_page, $body);
        $body = str_replace("[REQUEST_ID]", $id, $body);
        $body = str_replace("[USER_NAME]", $userName, $body);
        $body = str_replace("[TICKET]", $id, $body);
        $subject = $content->subject;
        $subject = str_replace("[PRODUCT_TYPE]", $data->productName, $subject);
        $subject = str_replace("[TICKET]", $id, $subject);

        if($data->productName == 'Others'){
            $subject = str_replace('for Others','',$subject);
            $body = str_replace('regarding the Others','', $body);
        }
        // dd($subject);
        // dd($body);
        $this->send_mail($body, $subject, $email);
    }

    public function admin_mail($emails, $type, $data, $info_page , $userName, $inserted_id)
    {
        // dd($emails);
        if($type == "support"){
            $content = EmailConfig::where("templateID", "SERVICE_EMAIL_TO_ADMIN")->first();
        }

        if($type == "new"){
            $content = EmailConfig::where("templateID", "NEWENQUIRY_EMAIL_TO_ADMIN")->first();
        }

        $body = $content->body;
        $body = str_replace("[USER_NAME]", $userName, $body);
        $body = str_replace("[PRODUCT_TYPE]", $data->productName, $body);
        $body = str_replace("[INFO_PAGE]", $info_page, $body);
        $body = str_replace("[TICKET]", $inserted_id, $body);
        $subject = $content->subject;
        $subject = str_replace("[TICKET]", $inserted_id, $subject);
        $subject = str_replace("[PRODUCT_TYPE]", $data->productName, $subject);

        if($data->productName == 'Others'){
            $subject = str_replace('for Others','',$subject);
            $body = str_replace('regarding the Others','', $body);
        }
        $emails = array_unique($emails);
        $emails = array_values($emails);
        // dd($emails);
        foreach ($emails as $email) {
            $this->send_mail($body, $subject, $email);
        }
    }

    public function add_service(Request $request, $type)
    {
        if($request->isMethod('POST')){
            try {
                $data = $request->post();
                $product = Product::find($request->productID);
                $location = Location::find($request->locationID);
                $region = Region::where("regionID", $location->regionID)->first();
                $admin_emails = "$location->email,$region->email";

                $data = array_merge($data, [
                    "locationName" => $location->name,
                    "regionID" => $region->id,
                    "regionName" => $region->regionID,
                    // "productID" => $request->productID,
                    "productType" => $product->productName,
                    "status" => "RECEIVED",
                    "issueDescription" => nl2br($request->issueDescription),
                    'requestTime' => date('Y-m-d H:i:s'),
                    // 'userID' => auth()->user()->id
                ]);

                if($request->hasFile('issues_images')){
                    $files = $request->file('issues_images');
                    $files_name = "";
                    foreach ($files as $file) {
                        $fileName = $data['name'].'_'.time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('support_issues'), $fileName);

                        if($files_name == ""){
                            $files_name = "support_issues/$fileName";
                        } else {
                            $files_name = "$files_name|support_issues/$fileName";
                        }
                    }

                    $data['issueImages'] = $files_name;
                }

                if($type == "support"){
                    // dd($data);
                    $create = ServiceInfo::create($data);
                    $inserted_id = $create->id;
                    $history = [
                        'serviceInfoID' => $inserted_id,
                        'status' => 'RECEIVED',
                        'timeInterval' => '0 seconds',
                        // 'userID' => auth()->user()->id
                    ];
                    $seviceHistory = ServiceInfoHistory::create($history);
                    $message = "Thank you requesting support!";
                    $text = "We will get back to you as soon as possible. <br /> Your Request Support ID is $inserted_id";
                }

                if($type == "new"){
                    $create = NewEnquiry::create($data);
                    $inserted_id = $create->id;
                    $history = [
                        'newEnquiryID' => $inserted_id,
                        'status' => 'RECEIVED',
                        'timeInterval' => '0 seconds',
                        // 'userID' => auth()->user()->id
                    ];
                    $newEnquiryHistory = NewEnquiryHistory::create($history);
                    $message = "Thank you enquirying with us!";
                    $text = "We will get back to you as soon as possible. <br /> Your Enquiry ID is $inserted_id";
                }

                $request_details = [
                    "Name" => $request->name,
                    "Email" => $request->email,
                    "Phone Number" => $request->phoneNumber,
                    "Issue Description" => nl2br($request->issueDescription),
                    "Location" => $location->name,
                    "Product" => $product->productName,
                ];
                $userName = $request->name;

                $info_page = "<table style='border-collapse: collapse;'>";
                    foreach ($request_details as $key => $value) {
                        $info_page .= "<tr style='width: 100%;'> <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$key:</td> <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$value</td> </tr>";
                    }
                $info_page .= "</table>";
    
                $this->admin_mail(explode(",", $admin_emails), $type, $product, $info_page ,$userName, $inserted_id);
                $this->user_email($data['email'], $type, $inserted_id, $product, $info_page ,$userName);

                $return = new Response([
                    "status" => "success",
                    "message" => $message,
                    "text" => $text
                ]);
                $return->setStatusCode(200);
            } catch (\Throwable $th) {
                $return = new Response([ "data" => [],"status" => "error", "message" => $th->getMessage(). "in line no [".$th->getLine()."]" ]);
                $return->setStatusCode(500);
            }
        } else {
            $return = new Response([
                "status" => "error",
                "message" => "Request method not allowed"
            ]);
            $return->setStatusCode(405);
        }

        return $return;
    }
}
