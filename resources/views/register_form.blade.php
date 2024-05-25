@extends('layouts.layout')

@section('title', 'регистрация')

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/register.css?v=').time()}}" rel="stylesheet">

    <div class="content">
        <form class="av-form" method="POST" action="/register/confirm" enctype="multipart/form-data"  style="--i: 0">
            @csrf

            <div class="form-title">
                <h3>Регистрация</h3>
                <div class="av-icon">
                    <img src="{{  asset('icons/black/door-open.svg') }}" alt="icon">
                </div>
            </div>



            <div class="inputs-block">

                <div class="input-block">
                    <label for="role">выберите роль</label>
                    <select name="role" id="role">
                        <option value="applicant" {{ old('role') == 'applicant' ? 'selected' : '' }}>соискатель</option>
                        <option value="recruiter" {{ old('role') == 'recruiter' ? 'selected' : '' }}>рекрутер</option>
                    </select>
                </div>
                
                <div class="input-block">
                    <label for="fullname">фио</label>
                    <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="введите фио...">
                    
                    @error('fullname')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

                <div class="input-block">
                    <label for="email">почта</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="введите почту...">
                    
                    @error('email')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

                <div class="input-block">
                    <label for="password">пароль</label>
                    <input type="password" name="password" placeholder="введите пароль...">
                    
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

                <div class="input-block">
                    <label for="password_confirmation">подтверждение пароля</label>
                    <input type="password" name="password_confirmation" placeholder="введите пароль...">
                    
                    @error('password_confirmation')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

            </div>



            <div class="form-nav">
                <button type="sybmit" class="fill-btn">зарегестрироваться</button>
                <p>Есть аккаунт? <a href="/login">Войти</a></p>
            </div>

        </form>
    </div>
@endsection