<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function login(){
        return view('login_form');
    }

    public function register(){
        return view('register_form');
    }

    public function login_confirm(Request $request)
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
            'mismatch' => 'Неверная почта или пароль',
        ]);
    }

    public function register_confirm(Request $request)
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

        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->contacts = $user->email;
        $profile->save();

        // Назначение роли пользователю
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        // Перенаправление пользователя на страницу входа с сообщением об успешной регистрации
        return redirect('/login')->with('status', 'Регистрация прошла успешно! Теперь вы можете войти в систему.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function searchApplicants(Request $request)
    {
        // Получение запроса поиска из GET-параметров
        $query = $request->input('query');

        // Проверка, что поле поиска не пустое
        if($query == null || trim($query) === "") {
            return view('applicant_list');
        }

        // Ищем совпадения в резюме и навыках
        $applicants = Profile::where('resume', 'like', "%{$query}%")
                            ->orWhere('skills', 'like', "%{$query}%")
                            ->orderBy('created_at', 'desc')
                            ->paginate(5);

        return view('applicant_list', compact('applicants', 'query'));
    }

}
