<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
        ];

        $messages = [
            'name.required' => 'Поле "Имя" не заполнeно',
            'email.required' => 'Поле "Email" не заполнeно',
            'email.unique' => 'Пользователь с таким email уже зарегестрирован',
            'email.email' => 'Укажите email в правильном формате',
            'password.required' => 'Поле "Password" не заполненно',
            'password.confirmed' => 'Пароли не совпадают',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();



        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]
        );


        Auth::user($user);
        return redirect()->home()->with('success', 'Вы успещно зарегестрировались');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $rules = [

            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [

            'email.required' => 'Поле "Email" не заполнeно',
            'email.email' => 'Укажите email в правильном формате',
            'password.required' => 'Поле "Password" не заполненно',

        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

            if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            ])) { if (Auth::user()->is_admin){
                return redirect('admin')->with('success', 'Добро пожаловать домой, Мастер.');
            } else {
                return redirect()->home()->with('success', 'Добро пожаловать домой.');
            }} else {
                return redirect()->route('login.create')->with('error', 'Логин или пароль были введены неверно.');
            }


    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
