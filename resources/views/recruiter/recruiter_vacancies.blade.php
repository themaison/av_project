@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
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

                            {{-- <div class="outline-btn" id="v-edit-{{ $vacancy->id }}">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                редактировать
                            </div> --}}

                            <button type="button" class="outline-btn" data-toggle="modal" data-target="#edit-modal">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                редактировать
                            </button>
 
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
                
        <div class="edit-modal" id="edit-modal">
            <button type="submit" class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </button>
            <form class="av-form" method="PUT" action="">
                @csrf

                <div class="form-title">
                    <h3>Редактировать вакансию</h3>
                </div>

                <div class="inputs-block">
                    <div class="input-block">
                        <label for="title">название вакансии</label>
                        <input type="text" name="title" value="{{ $vacancy->title }}" placeholder="введите текст...">
                        
                        @error('title')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-block">
                        <label for="company">компания (ИП)</label>
                        <input type="text" name="company"  value="{{ $vacancy->company }}" placeholder="введите текст...">
                        
                        @error('company')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection