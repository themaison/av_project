<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function login_form(){
        return view('login_form');
    }

    public function register_form(){
        return view('register_form');
    }

    public function login(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('applicant')) {
                return redirect()->intended('/vacancy_search');
            } elseif (Auth::user()->hasRole('recruiter')) {
                return redirect()->intended('/vacancy_search');
            }
        }

        return back()->withErrors([
            'error' => 'Неверная почта или пароль',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Назначение роли пользователю
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        // Перенаправление пользователя на страницу входа с сообщением об успешной регистрации
        return redirect()->route('login_form')->with('status', 'Регистрация прошла успешно! Теперь вы можете войти в систему.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login_form');
    }
}
