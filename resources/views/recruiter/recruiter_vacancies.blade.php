@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">

    <div class="content">

        <div class="title">
            <h2>мои вакансии</h2>
            <p>редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            {{-- <button class="fill-btn"><img src="{{ asset('icons/light/brush.svg') }}" alt="icon"><a href="/recruiter_vacancies/new_vacancy/">создать вакансию</a></button> --}}
            <a href="/recruiter_vacancies/new_vacancy/" class="fill-btn">
                <img src="{{ asset('icons/light/brush.svg') }}" alt="icon">
                создать вакансию
            </a>
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
                                    <div class="cover">
                                        <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                                    </div>
                                    {{-- <img src="{{ Storage::url($vacancy->cover) }}" class="av-img"> --}}
                                @else
                                    {{-- <div class="av-img"></div> --}}
                                    <div class="cover"></div>
                                @endif
                                <p>{{ $vacancy->title }}</p>
                            </a>

                        </div>

                        <div class="double-btn">

                            <div class="outline-btn" id="v-edit-{{  $vacancy->id }}">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                редактировать
                            </div>
 
                            <form action="/recruiter_vacancies/vacancy_delete/{{  $vacancy->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="outline-btn square-btn">
                                    <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                                </button>
                            </form>

                        </div>

                    </div>
                @empty
                    <p>У вас пока нет вакансий.</p>
                @endforelse
                
            </div>
        @endisset
    </div>
@endsection