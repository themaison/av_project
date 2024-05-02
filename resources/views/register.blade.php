@extends('layouts.layout')

@section('title', 'регистрация')

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/register.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login" class="w-head-btn">войти</a>
        <a href="/register">зарегистрироваться</a>
    @endsection

    <div class="content">
        <form class="av-form" method="POST" action="/register">

            <div class="form-title">
                <h3>Регистрация</h3>
                <div class="av-icon">
                    <img src="{{  asset('icons/chunk/door-open.svg') }}" alt="icon">
                </div>
            </div>



            <div class="inputs-block">

                <div class="input-block">
                    <label for="role">выберите роль</label>
                    <select name="role" id="userType">
                        <option value="applicant" selected>соискатель</option>
                        <option value="recruiter">рекрутер</option>
                    </select>
                </div>
                
                <div class="input-block">
                    <label for="fullname">фио</label>
                    <input type="text" name="fullname" placeholder="введите почту...">
                </div>

                <div class="input-block">
                    <label for="email">почта</label>
                    <input type="email" name="email" placeholder="введите почту...">
                </div>

                <div class="input-block">
                    <label for="pass">пароль</label>
                    <input type="password" name="pass" placeholder="введите пароль...">
                </div>

                <div class="input-block">
                    <label for="repeat-pass">подтверждение пароля</label>
                    <input type="password" name="repeat-pass" placeholder="введите пароль...">
                </div>

            </div>



            <div class="form-nav">
                <button type="sybmit" class="fill-btn">войти</button>
                <p>Есть аккаунт? <a href="/login" class="special-text">Войти</a></p>
            </div>

        </form>
    </div>
@endsection