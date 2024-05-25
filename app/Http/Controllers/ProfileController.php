<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index($id){

        $user = User::find($id);

        if ($user === null) {
            abort(404);
        }

        return view('profile', compact('user'));
    }

    public function update_profile(Request $request){
        $request->validate([
            'field' => 'required|string',
            'value' => 'nullable|string',
        ]);
    
        $field = $request->field;
        $value = nl2br(e($request->value));
    
        // Проверка, что поле допустимо для обновления
        if (!in_array($field, ['contacts', 'description', 'resume'])) {
            return response()->json(['error' => 'Invalid field'], 400);
        }
    
        // Получение профиля пользователя
        $profile = Auth::user()->profile;
    
        // Обновление поля профиля
        $profile->$field = empty($value) ? null : $value;
        $profile->save();
    
        return response()->json(['success' => true]);
    }
    
    
    
}
