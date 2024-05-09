@extends('layouts.layout')

@section('title', $vacancy->title)

@section('content')
    <link href="{{asset('css/vacancy_detail.css?v=').time()}}" rel="stylesheet">

    <div class="content">

        <div class="breakpoints">
            <a href="/vacancy_list">вакансии</a>
            <p>/</p>
            <a href="/vacancy_detail/{{  $vacancy->id }}" id="current-page">{{ $vacancy->title }}</a>
        </div>

        <div class="title">
            @if($vacancy->cover)
                <img src="{{ Storage::url($vacancy->cover) }}" alt="preview" class="vacancy-cover">
            @else
                <div class="vacancy-cover"></div>
            @endif
            
            <h2>{{ $vacancy->title }}</h2>

            @auth
                <div class="double-btn">
                    @if(auth()->user()->hasRole('applicant'))
                        <button class="fill-btn">откликнуться</button>
                        <button class="outline-btn square-btn"><img src="{{  asset('icons/black/gem.svg') }}" alt="icon"></button>
                    @elseif(auth()->user()->hasRole('recruiter'))
                        <button class="fill-btn"><a href="/vacancies/{{ $vacancy->id }}/edit"><img src="{{  asset('icons/light/pencil.svg') }}" alt="icon">редактировать</a></button>
                    @endif
                </div>
            @endauth
        </div>

        <div class="vacancy-description">

            <div class="double-block">
                <div class="inline-block" id="salary-block">
                    <h3>Вакансия</h3>

                    <div class="v-block-detail">
                        @if($vacancy->experience <= 0)
                            <p>Без опыта</p>
                        @else
                            <p>Опыт от {{ $vacancy->experience }} лет</p>
                        @endif

                        @if($vacancy->salary_from && $vacancy->salary_to)
                            <p class="tag">{{ $vacancy->salary_from }} — {{ $vacancy->salary_to }}₽</p>
                        @elseif($vacancy->salary_from)
                            <p class="tag">от {{ $vacancy->salary_from }}₽</p>
                        @elseif($vacancy->salary_to)
                            <p class="tag">до {{ $vacancy->salary_to }}₽</p>
                        @else
                            <p class="tag">Не указана</p>
                        @endif
                    </div>
                </div>

                <div class="inline-block" id="company-block">
                    <h3>Компания</h3>

                    <div class="v-block-detail">
                        <p>{{ $vacancy->company }}</p>
                        <p class="tag"><img src="{{  asset('icons/black/map-pin.svg') }}" alt="map-pin">{{ $vacancy->city }}</p>
                    </div>
                </div>

            </div>

            @if($vacancy->responsibilities)
                <div class="vacancy-content-block">
                    <h3>Обязанности</h3>
                    <p>{{ $vacancy->responsibilities }}</p>
                    {{-- <p> • Разработка сайтов и лендингов на Tilda<br>
                        • Поддержка существующих сайтов<br>
                        • Работа с визуальной составляющей сайтов<br>
                        • Интеграция сайта с Email, Yandex Direct, Google Adwords, VK, Facebook, Instagram, Telegram</p> --}}
                </div>
            @endif
            
            @if($vacancy->requirements)
                <div class="vacancy-content-block">
                    <h3>Требования</h3>
                    <p>{{ $vacancy->requirements }}</p>
                    {{-- <p> • Подтвержденный опыт работы на Tilda не менее 3 лет<br>
                        • Наличие сертификатов на прохождение курсов работы на Tilda и других обучающих программ<br>
                        • Опыт прототипирования сайта</p> --}}
                </div>
            @endif

            @if($vacancy->conditions)
                <div class="vacancy-content-block">
                    <h3>Условия</h3>
                    <p>{{ $vacancy->conditions }}</p>
                    {{-- <p> • Разработка сайтов и лендингов на Tilda<br>
                        • Белая заработная плата (оклад + премия)<br>
                        • График работы 5/2</p> --}}
                </div>
            @endif

            @if($vacancy->skills)
                <div class="vacancy-content-block">
                    <h3>Навыки</h3>
                    <div class="tags">
                        @foreach(explode(',', $vacancy->skills) as $skill)
                            <div class="tag">{{ $skill }}</div>
                        @endforeach

                        {{-- <div class="tag">Figma</div>
                        <div class="tag">Adobe Photoshop</div>
                        <div class="tag">Tilda</div>
                        <div class="tag">Adobe Illustrator</div>
                        <div class="tag">Miro</div> --}}
                    </div>
                </div>
            @endif
            
        </div>
    </div>
@endsection        
