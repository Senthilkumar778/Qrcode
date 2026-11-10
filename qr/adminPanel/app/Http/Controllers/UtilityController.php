<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


class UtilityController extends Controller{
    
    protected $userId = "";   
    protected $userRole = "";     
    
    function __construct(Request $request) {
          if($request->hasHeader('userId')){
            $this->userId = $request->Header('userId');
        }

        if($request->hasHeader('userRole')){
            $this->userRole = $request->Header('userRole');
        }
    }

    function getUserId(){
        return $this->userId;
    }

    function getUserRole(){
        return $this->userRole;
    }
    
}

?>