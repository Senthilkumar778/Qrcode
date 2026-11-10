<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\UTILITY\DataUtilityController;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;


class DataController extends Controller
{
    protected $table = "";

    function __construct(Request $request) {
        $getData = new UtilityController($request);
    }


    public function getInfo(Request $request)
    {
        try {
            if($this->debugFlag){ $funcStartTime = microtime(true); \DB::connection('mysqlConfig')->enableQueryLog();};

            $response['data']='';

            $response['status'] = "success";
            $return = new Response($response);
            $return->setStatusCode(200);

            if($this->debugFlag){  $response['query'] = DB::connection('mysqlConfig')->getQueryLog() ; $funcEndTime = microtime(true); $functionTimer = ['StartTime' => $funcStartTime, 'EndTime'=>$funcEndTime, 'Exec Time' => ($funcEndTime - $funcStartTime)]; $response['time'] = $functionTimer; };

        } catch (\Throwable $th) {
            $return = new Response([ "data" => [],"status" => "error", "message" => $th->getMessage(). "in line no [".$th->getLine()."]" ]);
            $return->setStatusCode(500);
        }

        return $return;
    }


}


?>
