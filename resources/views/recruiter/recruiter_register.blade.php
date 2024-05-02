@extends('layouts.layout')

@section('title', 'регистрация работодателя')

@section('content')
    <link href="{{asset('css/recruiter_register.css?v=').time()}}" stylesheet>
    
    @section('menu')
        <div class="w-head-btn">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/applicant_register">зарегистрироваться как соискатель</a>
        </div>
    @endsection
@endsection