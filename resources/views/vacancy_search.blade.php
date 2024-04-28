@extends('layouts.layout')

@section('title', 'поиск работы')

@section('content')
    <link href="css/vacancy_search.css" rel="stylesheet">

    @section('menu')
        <div class="av-btn-v1">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/register">зарегистрироваться</a>
        </div>
        <div>
            <a href="/favourite_jobs">избранное</a>
        </div>
        <div>
            <a href="/job_responses">отклики</a>
        </div>
        <div>
            <a href="/profile">имя</a>
        </div>
    @endsection

    <div class="content">

        <div class="search-box">
            <div class="user-role">
                <div class="role-btn" id="active-role">
                    я соискатель
                </div>
                <div class="role-btn">
                    я работодатель
                </div>
            </div>

            <h1>найди работу своей мечты</h1>
            <p>Более <span>1000</span> актуальных вакансий для всех</p>

            <form action="/vacancy_list" method="GET">
                <div class="input-group">
                    <input type="text" name="query" class="search" placeholder="Какая вакансия вас интересует?">
                    <button class="av-btn-v2" type="submit">найти</button>
                </div>
            </form>
        </div>
    </div>
@endsection