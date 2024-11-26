<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message){
        $reponse = [
            'sucess' => true,
            'message' => $message,
            'data' => $result
        ];
        return response()->json($reponse, 200);
    }

    public function sendError($error, $errorMeassage = [],$code = 404){
        $reponse = [
            'sucess' => true,
            'message' => $error,
        ];

        if(!empty($errorMeassage)){
            $reponse['error'] = $errorMeassage;
        }
        return response()->json($reponse, $code);
    }
}

