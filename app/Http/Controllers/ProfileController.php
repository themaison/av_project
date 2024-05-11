<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function update_profile(Request $request){
        $request->validate([
            'field' => 'required|string',
            'value' => 'nullable|string',
        ]);
    
        $field = $request->field;
        $value = $request->value;
    
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
