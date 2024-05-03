@extends('layouts.layout')

@section('title', 'авторизация')

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/login.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login_form" class="w-head-btn">войти</a>
        <a href="/register_form">зарегистрироваться</a>
    @endsection

    <div class="content">
        <form class="av-form" method="POST" action="/login_form/login" enctype="multipart/form-data">
            @csrf

            <div class="form-title">
                <h3>Авторизация</h3>
                <div class="av-icon">
                    <img src="{{  asset('icons/chunk/door-open.svg') }}" alt="icon">
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

            <div class="form-nav">
                <button type="sybmit" class="fill-btn">войти</button>
                <p>Еще не зарегистрированы? <a href="/register_form">Зарегистрироваться</a></p>
            </div>

        </form>
    </div>
@endsection