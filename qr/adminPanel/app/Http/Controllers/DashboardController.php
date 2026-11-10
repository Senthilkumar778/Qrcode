<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Region;
use App\Models\Product;
use App\Models\ServiceInfo;
use App\Models\ServiceInfoHistory;
use App\Models\NewEnquiry;
use App\Models\NewEnquiryHistory;
use App\Models\EmailConfig;
use App\Models\SubCategory;
use Session;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct(){
        date_default_timezone_set('asia/Kolkata');
    }

    public function getMonthlyData(){

        $data = [];
        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('-12 months', strtotime($endDate)));

        // Last 12 months
        $monthsWithCount = [];
        for ($i = 0; $i < 12; $i++) {
            $currentMonthStart = date('Y-m-01', strtotime("-$i months", strtotime($endDate)));
            $currentMonthEnd = date('Y-m-t', strtotime($currentMonthStart));

            $serviceInfo = DB::table('serviceInfo')
                ->whereBetween('createdAt', [$currentMonthStart, $currentMonthEnd])->count();
            $newEnquiry = DB::table('newEnquiry')
                ->whereBetween('createdAt', [$currentMonthStart, $currentMonthEnd])->count();

            $date = new \DateTime($currentMonthStart);
            $month = $date->format('M');
            $monthsWithCount[] = [
                'month' => $month,
                'serviceInfo' => $serviceInfo,
                'newEnquiry' => $newEnquiry,
            ];
        }
        $monthsWithCount = array_reverse($monthsWithCount); 
        // dd($monthsWithCount);
        return $monthsWithCount;

    }


    public function getLocationWiseData(){
        \DB::connection()->enableQueryLog();
        
        $serviceInfo = DB::table('serviceInfo')->select('locationName', DB::raw('COUNT(*) as count'))->whereNotNull('locationName')
        ->groupBy('locationID', 'locationName')->get();
        
        $serviceLocationData = [];
        foreach($serviceInfo as $key => $info){
            $locationData = [
                'locationName' => $info->locationName,
                'serviceInfoCount' => $info->count
            ];
            array_push($serviceLocationData, $locationData);
        }
        // dd($serviceLocationData);

        $newEnquiry = DB::table('newEnquiry')->select('locationName', DB::raw('COUNT(*) as count'))->whereNotNull('locationName')
        ->groupBy('locationID','locationName')->get();

        $enquiryLocationData = [];
        foreach($newEnquiry as $key => $enquiry){
            $locationData = [
                'locationName' => $enquiry->locationName,
                'newEnquiryCount' => $enquiry->count
            ];
            array_push($enquiryLocationData, $locationData);
        }
        // dd($enquiryLocationData);`
        $locationWiseData = [
            'serviceInfo' => $serviceLocationData,
            'newEnquiry' => $enquiryLocationData
        ];

        return $locationWiseData;
    }

    public function getZoneWiseData(){
        $serviceInfo = DB::table('serviceInfo')->select('regionID','regionName', DB::raw('COUNT(*) as count'))->whereNotNull('regionID')
        ->groupBy('regionID', 'regionName')->get();

        $serviceZoneData = [];
        foreach($serviceInfo as $key => $info){
            $zoneData = [
                'regionName' => $info->regionName,
                'serviceInfoCount' => $info->count
            ];
            array_push($serviceZoneData, $zoneData);
        }
        // dd($serviceZoneData);

        $newEnquiry = DB::table('newEnquiry')->select('regionName', DB::raw('COUNT(*) as count'))->whereNotNull('regionID')->whereNotNull('regionName')
        ->groupBy('regionName')->get();
        // dd($newEnquiry);
        $newEnquiryZoneData = [];
        foreach($newEnquiry as $key => $enquiry){
            $zoneData = [
                'regionName' => $enquiry->regionName,
                'newEnquiryCount' => $enquiry->count
            ];
            array_push($newEnquiryZoneData, $zoneData);
        }
        // dd($newEnquiryZoneData);
        $zoneWiseData = [
            'serviceInfo' => $serviceZoneData,
            'newEnquiry' => $newEnquiryZoneData
        ];
        return $zoneWiseData;
    } 

    public function index(){
        
        $data = [];
        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('-7 days', strtotime($endDate)));

        $totalServiceInfoCount  = ServiceInfo::count();
        $totalNewEnquiryCount = NewEnquiry::count();

        $authUserServiceInfoCount  = ServiceInfo::where('userID', auth()->user()->id)->count();
        $authUserNewEnquiryCount = NewEnquiry::where('userID', auth()->user()->id)->count();

        $recentServiceInfo = ServiceInfo::orderBy('createdAt','desc')->limit(15)->get();
        $recentNewEnquiry = NewEnquiry::orderBy('createdAt','desc')->limit(15)->get();
        
        //Last 7 days 
        $datesWithCount = [];
        for ($i = 0; $i < 7; $i++) {
            $currentDate = date('Y-m-d', strtotime("-$i days", strtotime($endDate)));
            $serviceInfo = DB::table('serviceInfo')
                ->whereDate('createdAt', $currentDate)->count();
            $newEnquiry = DB::table('newEnquiry')
                ->whereDate('createdAt', $currentDate)->count();

            $date = new \DateTime($currentDate);
            $currentDate = $date->format('d-m-Y');
            $datesWithCount[] = [
                'date' => $currentDate,
                'serviceInfo' => $serviceInfo,
                'newEnquiry' => $newEnquiry,
            ];
        }
        $datesWithCount = array_reverse($datesWithCount);
        // dd($datesWithCount);
        $totalCountData = [
            'totalServiceInfoCount' => $totalServiceInfoCount,
            'totalNewEnquiryCount' => $totalNewEnquiryCount
        ];

        $authUserCountData = [
            'authUserServiceInfoCount' => $authUserServiceInfoCount,
            'authUserNewEnquiryCount' => $authUserNewEnquiryCount
        ];

        $recentData = [
            'recentServiceInfo' => $recentServiceInfo,
            'recentNewEnquiry' => $recentNewEnquiry
        ];

        $serviceStatusCount = ServiceInfo::select('status', DB::raw('count(*) as statusCount'))->groupBy('status')->get();
        $newEnquiryStatusCount = NewEnquiry::select('status', DB::raw('count(*) as statusCount'))->groupBy('status')->get();

        $statusCount = [
            'serviceStatusCount' => $serviceStatusCount,
            'newEnquiryStatusCount' => $newEnquiryStatusCount
        ];

        // dd($statusCount);
        $monthlyData = $this->getMonthlyData();
        $locationWiseData = $this->getLocationWiseData();
        $zoneWiseData = $this->getZoneWiseData();
   
        $dashboardData = [
            'datesWithCount' => $datesWithCount,
            'totalCountData' => $totalCountData,
            'authUserCountData' => $authUserCountData,
            'recentData' => $recentData,
            'statusCount' => $statusCount,
            'monthlyData' => $monthlyData,
            'locationWiseData' => $locationWiseData,
            'zoneWiseData' => $zoneWiseData
        ];

        return view('index', compact('dashboardData'));
    }
}
