<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewEnquiry;
use App\Models\NewEnquiryHistory;
use App\Models\SubCategory;
use App\Models\Location;
use Session;
use Carbon\Carbon;

class NewEnquiryController extends Controller
{
    public function __construct(){
        date_default_timezone_set('asia/kolkata');
    }

    // ===== CHANGED FUNCTION (filters + dashboard chart links) =====
    public function index(Request $request){

        $regionID = auth()->user()->regionID;
        $role = auth()->user()->userRole;

        // Your existing role check (unchanged)
        if($role == 'SystemSpecialist' || $role =='SuperAdmin' || $role =='Admin' || $role =='Manager'){
            $query = NewEnquiry::query();
        }else{
            $query = NewEnquiry::where('regionID', $regionID);
        }

        // DATE RAISED  (uses requestTime, or createdAt when requestTime is empty)
        $dateColumn = 'COALESCE(requestTime, createdAt)';

        if ($request->date === 'custom') {
            // Custom date range: from / to (a single day = same from and to)
            try {
                $from = $request->filled('from') ? Carbon::parse($request->from)->startOfDay() : null;
                $to   = $request->filled('to')   ? Carbon::parse($request->to)->endOfDay()     : null;
                if ($from && $to && $from->gt($to)) {
                    [$from, $to] = [$to->copy()->startOfDay(), $from->copy()->endOfDay()];
                }
                if ($from) { $query->whereRaw("$dateColumn >= ?", [$from->format('Y-m-d H:i:s')]); }
                if ($to)   { $query->whereRaw("$dateColumn <= ?", [$to->format('Y-m-d H:i:s')]); }
            } catch (\Exception $e) {
                // ignore an invalid date
            }
        } elseif ($request->filled('date')) {
            // One month, value looks like 2025-12
            try {
                $month = Carbon::createFromFormat('!Y-m', $request->date);
                $query->whereRaw("$dateColumn BETWEEN ? AND ?", [
                    $month->copy()->startOfMonth()->format('Y-m-d H:i:s'),
                    $month->copy()->endOfMonth()->format('Y-m-d H:i:s'),
                ]);
            } catch (\Exception $e) {
                // ignore an invalid date value
            }
        }

        // LOCATION, REGION, STATUS
        if ($request->filled('location')) { $query->where('locationName', $request->location); }
        if ($request->filled('region'))   { $query->where('regionName', $request->region); }
        if ($request->filled('status'))   { $query->where('status', $request->status); }

        $newEnquiries = $query->orderBy('id', 'desc')->get();

        // MONTH LIST: newest first, January 2024 to current month
        $dateMonths = [];
        $startMonth = Carbon::create(2024, 1, 1)->startOfMonth();
        $endMonth   = Carbon::now()->startOfMonth();
        for ($m = $endMonth->copy(); $m->gte($startMonth); $m->subMonth()) {
            $dateMonths[$m->format('Y-m')] = $m->format('F Y');
        }

        // DROPDOWN LISTS
        $locations = Location::orderBy('name')->pluck('name');
        if ($request->filled('location') && !$locations->contains($request->location)) {
            $locations->push($request->location);      // e.g. "Other", opened from a dashboard chart
        }

        $regions  = ['International', 'North', 'Others', 'South', 'SouthCentral', 'West'];

        $statuses = ['RECEIVED', 'ACKNOWLEDGED', 'WIP', 'QUOTE SENT', 'ORDER RECEIVED-CLOSED', 'ORDER LOST-CLOSED'];
        if ($request->filled('status') && !in_array($request->status, $statuses)) {
            $statuses[] = $request->status;            // any other status opened from the status pie chart
        }

        return view('newEnquiry.index', compact('newEnquiries', 'dateMonths', 'locations', 'regions', 'statuses'));
    }
    // ===== END CHANGED FUNCTION =====

    public function updateNewEnquiryStatus(Request $request){
        $vavlidated = $request->validate([
            'newEnquiryID' => ' required',
            'status' => 'nullable',
            'remarks' => 'nullable'
        ]);
        $newEnquiryID = $vavlidated['newEnquiryID'];
        $newEnquiry = NewEnquiry::find($newEnquiryID);

        $newEnquiryUpdated =  $newEnquiry->update([
            'status' => $vavlidated['status'],
            'remarks' => $vavlidated['remarks']
        ]);

        if($newEnquiryUpdated){
            $data['status'] = "success";
            $data['message'] = "Status updated successfully";
        }else{
            $data['status'] = "error";
            $data['message'] = "Unable to  update status";
        }

        return response()->json($data);
    }

    public function edit($id){
        $newEnquiryEdit = NewEnquiry::find($id);
        $newEnquiryHistory = NewEnquiryHistory::where('newEnquiryID',$id)->orderBy('id', 'desc')->get();

        return view('newEnquiry.edit', compact('newEnquiryEdit', 'newEnquiryHistory'));
    }

    public function update(Request $request, $id){
        $vavlidated = $request->validate([
            'status' => 'nullable',
            'remarks'=> 'nullable',
            'subcategoryName' => 'nullable',
            'subcategoryID' => 'nullable',
            'issueDescription' => 'nullable',
            'userID' => 'nullable'
        ]);
        $vavlidated['issueDescription'] = nl2br($vavlidated['issueDescription']);
        $vavlidated['remarks'] = nl2br($vavlidated['remarks']);
        $vavlidated['userID'] = auth()->user()->id;
        $newEnquiry = NewEnquiry::find($id);

        $newEnquiryUpdated =  $newEnquiry->update($vavlidated);

        if($newEnquiryUpdated){

            $previousRecord = NewEnquiryHistory::where('newEnquiryID', $id)->orderBy('id', 'desc')->first();
            $createdAt = $previousRecord->createdAt ?? null;
            if ($createdAt == null) {
                $previousTime = Carbon::now();
            } else {
                $previousTime = Carbon::parse($createdAt);
            }
            $currentTime = Carbon::now();
            $timeDifference = $currentTime->diff($previousTime);
            $timeInterval = '';
           
            if ($timeDifference->d > 0) {
                $timeInterval .= $timeDifference->d . ' days ';
            }
            if ($timeDifference->h > 0) {
                $timeInterval .= $timeDifference->h . ' hours ';
            }
            if ($timeDifference->i > 0) {
                $timeInterval .= $timeDifference->i . ' minutes ';
            }
            if ($timeDifference->s > 0 && empty($timeInterval)) {
                $timeInterval .= $timeDifference->s . ' seconds';
            }
            $timeInterval = trim($timeInterval);
            
            if (empty($timeInterval)) {
                $timeInterval = '0 seconds';
            }
            $saveHistory = NewEnquiryHistory::create([
                'newEnquiryID' => $id,
                'status' => $vavlidated['status'],
                'remarks' => $vavlidated['remarks'],
                'timeInterval' => $timeInterval,
                'subcategoryName' => $vavlidated['subcategoryName'] ?? '',
                'userID' => auth()->user()->id
            ]); 
            Session::flash('success', 'New Enquiry Info updated successfully');
            $mailInfo = [
                'ticketID' => 'N'.$id,
                'userName' =>auth()->user()->firstName.' '.auth()->user()->lastName,
                'userEmail' =>auth()->user()->email ?? '',
                "status" => $vavlidated['status'],
                "remarks" => $vavlidated['remarks'],
                'regionName' => $request->regionName,
                "locationName" => $request->locationName,
                'issueDescription' => $request->issueDescription,
                'updatedAt' =>  date('d-m-Y h:i a'),
                'productName' => $request->productType,
                'clientName' => $request->name
            ];

            try{
                $this->statusUpdateEmailAdmin($request->regionId, $request->locationId, $mailInfo);
                $this->statusUpdateEmailUser($id, $mailInfo,'newEnquiry');
            }catch(\Exception $e){
                Session::flash('error', 'Error in sending update email');
            }
        }else{
            Session::flash('error', 'Unable to update new enquiry');
        }

        return redirect('newEnquiries');
    }

    public function destroy($id){
        $newEnquiry = NewEnquiry::find($id);
        $newEnquiryDelete =  $newEnquiry->delete();

        if($newEnquiryDelete){
            Session::flash('success', 'New Enquiry Info Deleted successfully');
        }else{
            Session::flash('error', 'Unable to Delete new enquiry');
        }
        return redirect('newEnquiries');
    }

    public function newEnquiryHistory($id){
        $newEnquiryHistory = NewEnquiryHistory::where('newEnquiryID',$id)->orderBy('id', 'desc')->get();
        return view('newEnquiry.view', compact('newEnquiryHistory'));
    }

}