@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">

    <div class="content">

        <div class="title">
            <h2>отклики</h2>
            <p>отклики на ваши вакансии за последнее время</p>
        </div>

        <div class="av-list">   
            <div class="l-row">
                <div class="set">

                    <div class="elem">
                        <p class="hint-text">30.04.2024 | 21:23</p>
                    </div>

                    <a href="/" class="elem">
                        <div class="av-img"></div>
                        {{-- <img src="{{ asset('images/job_prev.jpg') }}" class="prev"> --}}
                        <p>Имя Фамилия Отчество</p>
                    </a>

                    <div class="elem">
                        <img src="{{ asset('icons/blue/envelope.svg') }}" alt="icon">
                        <p>сообщение</p>
                    </div>

                    <a href="/" class="elem">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="av-img">
                        <p>Наименование вакансии</p>
                    </a>

                </div>

                <button class="outline-btn square-btn"><img src="{{ asset('icons/black/3-dots-vertical.svg') }}" alt="icon"></button>
            </div>
        </div>
    </div>
@endsection