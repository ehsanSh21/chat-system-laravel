<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

//    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {

        return view('auth.register');
    }

    public function register(UserRequest $request)
    {

//        dd($request->all());

        $items = User::with(['image'])->
        orderBy('id','desc')
            ->paginate(3)
        ;

//        event(new Registered($user = $this->create($request->validated())));
//        $this->guard()->login($user);
        $data = $request->validated();
        $user = User::create($data);
        Auth::login($user);
//        dd($user);
        return redirect()->route('home');
//        dd($user);

//        return redirect(route('admin.user.index',compact('items')));


    }

    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *

     */
//    protected function validator(array $data)
//    {
//        dd($data);
//        return Validator::make($data, [
//            'name' => ['required', 'string', 'max:255'],
//            'last_name' => ['required', 'string', 'max:255'],
//            'phone' => ['required'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required'],
//        ]);
//    }
//
//    /**
//     * Create a new user instance after a valid registration.
//     *
//     * @param  array  $data
//     * @return \App\Models\User
//     */
//    protected function create(array $data)
//    {
//        dd($data);
//        return User::create([
//            'name' => $data['name'],
//            'last_name' => $data['last_name'],
//            'phone' => $data['phone'],
//            'email' => $data['email'],
//            'password' => $data['password'],
//        ]);
//    }
}
