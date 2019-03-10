<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class UserRegistratorService{


    public static function create(array $data, $withValidation = false)
    {

        if ($withValidation) self::validate($data);

        return Usuario::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public static function validate(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:usuarios',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();
    }
}
