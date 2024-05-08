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
            <button class="fill-btn"><img src="{{ asset('icons/light/brush.svg') }}" alt="icon"><a href="/recruiter_vacancies/new_vacancy/">создать вакансию</a></button>
        </div>

        @isset($vacancies)
            <div class="av-list">
                
                {{-- <div class="l-row">
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
                </div> --}}
                
                @forelse ($vacancies as $vacancy)
                    <div class="l-row">
                        <div class="set">

                            <div class="elem">
                                <p class="hint-text">{{ $vacancy->created_at }}</p>
                            </div>

                            <a href="/vacancy_detail/{{ $vacancy->id }}" class="elem">
                                @if($vacancy->cover)
                                    <img src="{{ asset('images/' . $vacancy->cover) }}" class="av-img">
                                @else
                                    <div class="av-img"></div>
                                @endif
                                <p>{{ $vacancy->title }}</p>
                            </a>

                        </div>

                        <div class="double-btn">
                            <button class="outline-btn"><a href="/vacancies/{{ $vacancy->id }}/edit"><img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">редактировать</a></button>
                            <button type="submit" class="outline-btn square-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="icon"></button>
                            {{-- <form action="/vacancies/{{ $vacancy->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="outline-btn square-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="icon"></button>
                            </form> --}}
                        </div>

                    </div>
                @empty
                    <p>У вас пока нет вакансий.</p>
                @endforelse
                
            </div>
        @endisset
    </div>
@endsection