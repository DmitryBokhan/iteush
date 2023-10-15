<?php
/**
 *  Аутентификация через API
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthUserRequest;
//use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        //Назначим роль User при регистрации пользователя
        $user->assignRole('User');

        return response($response, 201);
    }

    public function login(Request $request)
    {

        //проверяем есть ли пользователь с таким email
        $user = User::where('email', $request['email'])->first();

        //проверяем пароль
        if(!$user || !Hash::check($request['password'], $user->password)){
            return response(['message' => 'Пользователь с такими данными не зарегистрирован'], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Вы покинули систему',
        ];
    }
}
