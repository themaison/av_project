@extends('layouts.layout')

@section('title', 'авторизация')

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/login.css?v=').time()}}" rel="stylesheet">

    <div class="content">
        <form class="av-form" method="POST" action="/login/confirm" enctype="multipart/form-data"  style="--i: 0">
            @csrf

            <div class="form-title">
                <h3>Авторизация</h3>
                <div class="av-icon">
                    <img src="{{  asset('icons/black/door-open.svg') }}" alt="icon">
                </div>
            </div>

            <div class="inputs-block">

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

            </div>

            @if($errors->first('mismatch'))
                <p class="error-text">{{ $errors->first('mismatch') }}</p>
            @endif

            <div class="form-nav">
                <button type="sybmit" class="fill-btn">войти</button>
                <p>Еще не зарегистрированы? <a href="/register">Зарегистрироваться</a></p>
            </div>

        </form>
    </div>
@endsection