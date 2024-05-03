@extends('layouts.layout')

@section('title', 'регистрация')

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/register.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login_form" class="w-head-btn">войти</a>
        <a href="/register_form">зарегистрироваться</a>
    @endsection

    <div class="content">
        <form class="av-form" method="POST" action="/register_form/register" enctype="multipart/form-data">
            @csrf

            <div class="form-title">
                <h3>Регистрация</h3>
                <div class="av-icon">
                    <img src="{{  asset('icons/chunk/door-open.svg') }}" alt="icon">
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
                    <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="введите почту...">
                    
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
                    <label for="pass_confirmation">подтверждение пароля</label>
                    <input type="password" name="pass_confirmation" placeholder="введите пароль...">
                    
                    @error('pass_confirmation')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

            </div>



            <div class="form-nav">
                <button type="sybmit" class="fill-btn">войти</button>
                <p>Есть аккаунт? <a href="/login_form">Войти</a></p>
            </div>

        </form>
    </div>
@endsection