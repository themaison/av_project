@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">

    <div class="content">

        <div class="title">
            <h2>мои вакансии</h2>
            <p>редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            <button class="fill-btn"><img src="{{ asset('icons/light/brush.svg') }}" alt="icon"><a href="/new_vacancy">создать вакансию</a></button>
        </div>

        <div class="av-list">
            
            <div class="l-row">
                <div class="set">

                    <div class="elem">
                        <p class="hint-text">30.04.2024 | 21:23</p>
                    </div>

                    <a href="/" class="elem">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="av-img">
                        <p>Наименование вакансии</p>
                    </a>

                </div>
                
                <div class="double-btn">
                    <button class="outline-btn"><img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">редактировать</button>
                    <button class="outline-btn square-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="icon"></button>
                </div>
            </div>

        </div>
    </div>
@endsection