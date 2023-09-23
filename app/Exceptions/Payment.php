<?php

namespace App\Exceptions;

use App\Http\Services\User\UserService;
use Illuminate\Support\Facades\Log;

class Payment
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        Log::info('sdfsdfs');
        $this->userService = $userService;
    }

//    public function charge($amount)
//    {
//        return [
//            "amount"=>$amount,
//            "trans"=>'sdfsdf'.rand(1,20),
//            "currency"=>$this->currency,
//        ];
//    }

}
