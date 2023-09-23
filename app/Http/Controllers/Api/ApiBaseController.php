<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function successResponse($data,string $message= null ,$statusCode=200){
        return response()->json(compact('data','message'), $statusCode);
    }

}
