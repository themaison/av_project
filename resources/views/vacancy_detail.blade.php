@extends('layouts.layout')

@section('title', $vacancy->title)

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/vacancy_detail.css?v=').time()}}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            
            $('.response-btn').click(function() {
                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
            });
 
            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').fadeOut();
                $('.blur-bg').fadeOut();
            });

            $(document).mouseup(function (e) {
                var container = $(".av-form");
                if (container.has(e.target).length === 0){
                    container.fadeOut();
                    $('.blur-bg').fadeOut();
                }
            });
        });

    </script>

    <div class="content">

        <div class="blur-bg"></div>

        <div class="breakpoints" style="--i: 0">
            <a href="{{ url()->previous() }}">вакансии</a>
            <p>/</p>
            <a href="/vacancy_detail/{{  $vacancy->id }}" id="current-page">{{ $vacancy->title }}</a>
        </div>

        <form class="av-form" method="POST" action="/applicant/create_response" enctype="multipart/form-data"  style="display: none">
            @csrf

            <div class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </div>

            <div class="form-title">
                <h3>Отклик</h3>

                <div class="av-icon">
                    <img src="{{  asset('icons/black/hand-tap.svg') }}" alt="icon">
                </div>

            </div>

            <div class="inputs-block">

                <div class="input-block">
                    <label for="message">сопроводительное письмо</label>
                    <textarea name="message" placeholder="введите текст...">{{ old('message') }}</textarea>
                    
                    @error('message')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <div class="form-nav">
                <button type="sybmit" class="fill-btn">откликнуться</button>
                <div class="outline-btn cancel-btn">отменить</div>
            </div>

        </form>

        <div class="title">
            @if($vacancy->cover)
                <div class="cover" style="--i: 1">
                    <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                </div>
            @else
                <div class="cover" style="--i: 1"></div>
            @endif
            
            <h2 class="vacancy-title" style="--i: 2">{{ $vacancy->title }}</h2>

            @auth
                <div class="double-btn" style="--i: 3">
                    @if(auth()->user()->hasRole('applicant'))
                        <div class="fill-btn response-btn">откликнуться</div>
                        <a href="/applicant/add_to_favorite" class="outline-btn square-btn"><img src="{{  asset('icons/black/gem.svg') }}" alt="icon"></a>
                    @elseif(auth()->user()->hasRole('recruiter'))
                        <div class="fill-btn"><a href="/vacancies/{{ $vacancy->id }}/edit"><img src="{{  asset('icons/light/pencil.svg') }}" alt="icon">редактировать</a></div>
                    @endif
                </div>
            @endauth
        </div>

        <div class="vacancy-description">

            <div class="double-block">
                <div class="inline-block" id="salary-block" style="--i: 4">
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

                <div class="inline-block" id="company-block" style="--i: 5">
                    <h3>Компания</h3>

                    <div class="v-block-detail">
                        <p>{{ $vacancy->company }}</p>
                        <p class="tag"><img src="{{  asset('icons/black/map-pin.svg') }}" alt="map-pin">{{ $vacancy->city }}</p>
                    </div>
                </div>

            </div>

            @if($vacancy->responsibilities)
                <div class="vacancy-content-block" style="--i: 6">
                    <h3>Обязанности</h3>
                    <p>{{ $vacancy->responsibilities }}</p>
                </div>
            @endif
            
            @if($vacancy->requirements)
                <div class="vacancy-content-block" style="--i: 7">
                    <h3>Требования</h3>
                    <p>{{ $vacancy->requirements }}</p>
                </div>
            @endif

            @if($vacancy->conditions)
                <div class="vacancy-content-block" style="--i: 8">
                    <h3>Условия</h3>
                    <p>{{ $vacancy->conditions }}</p>
                </div>
            @endif

            @if($vacancy->skills)
                <div class="vacancy-content-block" style="--i: 9">
                    <h3>Навыки</h3>
                    <div class="tags">
                        @foreach(explode(',', $vacancy->skills) as $skill)
                            <div class="tag">{{ $skill }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        </div>
    </div>
@endsection        
