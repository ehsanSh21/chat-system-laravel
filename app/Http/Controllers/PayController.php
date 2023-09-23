<?php

namespace App\Http\Controllers;

use App\Exceptions\Payment;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;

class PayController extends Controller
{
//    public function store(Payment $payment )
//    {
////        $payment = new Payment('euro');
//         dd($payment->charge(50));
//
//    }

    private UserService $userService;

    public function __construct(UserService $userService)
{
    $this->userService = $userService;
}


}
