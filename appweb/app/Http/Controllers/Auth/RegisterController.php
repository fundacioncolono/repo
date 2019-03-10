<?php

namespace App\Http\Controllers\Auth;

use App\Services\UserRegistratorService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return UserRegistratorService::create($data);
    }

    public function register(Request $request){

        $values = $request->all();

        UserRegistratorService::validate($values);

        event(new Registered($user = $this->create($values)));

        // $this->guard()->login($user);

        return $this->registered($request, $user)? : redirect($this->redirectPath());
    }
}
