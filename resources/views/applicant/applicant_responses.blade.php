@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/applicant_responses.css?v=').time()}}" rel="stylesheet">

    <div class="content">

        <div class="title">
            <h2>отклики</h2>
            <p>ваши отклики за последнее время</p>
        </div>

        <div class="av-list">
            <div class="l-row">

                <div class="set">
                    <div class="elem">
                        <p class="hint-text">30.04.2024 | 21:23</p>
                    </div>


                    <div class="elem">
                        <p class="stat0">не рассмотрено</p>
                    </div>

                    <a href="/" class="group-elem">
                        <div class="elem">
                            @if(isset($vacancy)  && $vacancy->cover)
                                <div class="cover">
                                    <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                                </div>
                                {{-- <img src="{{ Storage::url($vacancy->cover) }}" class="av-img"> --}}
                            @else
                                    {{-- <div class="av-img"></div> --}}
                                <div class="cover"></div>
                            @endif
                            {{-- <img src="{{ asset('images/job_prev.jpg') }}" class="av-img"> --}}
                            <p>Наименование вакансии</p>
                        </div>
    
                        <div class="elem">
                            <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                            <p>IT Pelag</p>
                        </div>
                    </a>
                    {{-- <a href="/" class="elem">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="av-img">
                        <p>Наименование вакансии</p>
                    </a>

                    <div class="elem">
                        <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                        <p>IT Pelag</p>
                    </div> --}}

                </div>

                <button class="outline-btn square-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="icon"></button>
            </div>
        </div> 
    </div>

    {{-- <div class="pagination">
        <div class="page">1</div>
        <div class="page">2</div>
        <div class="page">3</div>
    </div> --}}
@endsection