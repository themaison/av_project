@extends('layouts.layout')

@section('title', 'регистрация соискателя')

@section('content')
    <link href="{{asset('css/applicant_register.css?v=').time()}}" stylesheet>
    
    @section('menu')
        <div class="w-head-btn">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/recruiter_register">зарегистрироваться как рекрутёр</a>
        </div>
    @endsection
@endsection