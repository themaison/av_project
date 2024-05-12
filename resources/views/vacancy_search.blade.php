@extends('layouts.layout')

@section('title', 'поиск работы')

@section('content')

    <link href="{{asset('css/vacancy_search.css?v=').time()}}" rel="stylesheet">
    
    <script>
 
    </script>
    

    <div class="content">

        <div class="search-box">
            <div class="user-role" style="--i: 0">
                <div class="role-btn" id="active-role">
                    вакансии
                </div>
                <div class="role-btn">
                    резюме
                </div>
            </div>

            <h1 style="--i: 1">найди работу своей мечты</h1>
            <p style="--i: 2">Более <span>1000</span> актуальных вакансий для всех</p>

            <form action="/vacancy_list" method="GET" style="--i: 3">
                <div class="input-group">
                    <input type="text" name="query" class="search" id="search" placeholder="Какая вакансия вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>
        </div>
    </div>

@endsection
