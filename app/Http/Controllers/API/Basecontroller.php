<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Basecontroller extends Controller
{
    public function sendResponse($result , $message){
        $response=[
            'status'=>true,
            'message'=>$message,
            'data'=>$result
        ];

        return response()->json($response,200);
    }

    public function sendError($error , $errorMessage=[] , $code=404){
        $response = [
            'status'=>false,
            'message'=>$error
        ];

        if(!empty($errorMessage)){
            $response['data']=$errorMessage;
        }

        return response()->json($response , $code);
    }
}
