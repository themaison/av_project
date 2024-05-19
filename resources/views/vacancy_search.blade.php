@extends('layouts.layout')

@section('title', 'поиск вакансий')

@section('content')

    <link href="{{asset('css/vacancy_search.css?v=').time()}}" rel="stylesheet">
    
    <script>
        $(document).ready(function() {
            // Скрываем форму поиска резюме по умолчанию
            $('#applicant-search').hide();
            $('#applicant-title').hide();
            $('#applicant-subtitle').hide();

            // Обработчик клика по переключателю вакансий
            $('#vacancy-toggle').click(function() {
                $(this).addClass('active-toggle');
                $('#resume-toggle').removeClass('active-toggle');
                $('#vacancy-search').show();
                $('#vacancy-title').show();
                $('#vacancy-subtitle').show();
                

                $('#applicant-search').hide();
                $('#applicant-title').hide();
                $('#applicant-subtitle').hide();
            });

            // Обработчик клика по переключателю резюме
            $('#resume-toggle').click(function() {
                $(this).addClass('active-toggle');
                $('#vacancy-toggle').removeClass('active-toggle');
                $('#applicant-search').show();
                $('#applicant-title').show();
                $('#applicant-subtitle').show();

                $('#vacancy-search').hide();
                $('#vacancy-title').hide();
                $('#vacancy-subtitle').hide();
            });
        });

    </script>
    

    <div class="content">

        <div class="search-box">
            <div class="toggle-type" style="--i: 0">
                <div id="vacancy-toggle" class="toggle-btn active-toggle">
                    вакансии
                </div>
                <div id="resume-toggle" class="toggle-btn">
                    резюме
                </div>
            </div>

            <h1 id="vacancy-title" style="--i: 1">найди работу своей мечты</h1>
            <p id="vacancy-subtitle" style="--i: 2">Более <span>1000</span> актуальных вакансий для всех</p>

            <form id="vacancy-search" action="/vacancy_list" method="GET" style="--i: 3">
                <div class="input-group">
                    <input type="text" name="query" class="search" id="search" placeholder="Какая вакансия вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>

            <h1 id="applicant-title" style="--i: 1">найди лучшего сотрудника</h1>
            <p id="applicant-subtitle" style="--i: 2">Более <span>1000</span> актуальных резюме</p>

            <form id="applicant-search" action="/applicant_list" method="GET" style="--i: 3">
                <div class="input-group">
                    <input type="text" name="query" class="search" id="search" placeholder="Какое резюме вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>

        </div>

    </div>

@endsection
