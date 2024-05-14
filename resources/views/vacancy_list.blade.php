@extends('layouts.layout')

@section('title', 'запрос')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/vacancy_list.css?v=').time()}}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('.favorite-btn').click(function(event) {
                event.preventDefault();
        
                var vacancyId = $(this).data('vacancy-id');
                var button = $(this);
        
                $.ajax({
                    url: '/vacancy/' + vacancyId + '/toggle_favorite',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.favorite) {
                            button.removeClass('outline-btn').addClass('hint-btn');
                        } else {
                            button.removeClass('hint-btn').addClass('outline-btn');
                        }
                    }
                });
            });
        });
    </script>

    <div class="content">
        <div class="search-box">
            @php
                function getVacancyWord($number) {
                    $cases = array (2, 0, 1, 1, 1, 2);
                    $words = array('вакансия', 'вакансии', 'вакансий');
                    $index = ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)];
                    return $words[$index];
                }
            @endphp

            @if(isset($vacancies) && $vacancies->count() > 0)
                <h2 style="--i: 0">«{{ $query }}»</h2>
                <p style="--i: 1">найдено <span>{{ $vacancies->count() }} {{ getVacancyWord($vacancies->count()) }}</span></p>
            @else
                <h2 style="--i: 0">Пусто</h2>
                <p class="hint-text" style="--i: 1">по запросу ничего не найдено</span></p>
            @endif
            
            <form action="/vacancy_list" method="GET"  style="--i: 3">
                <div class="input-group">
                    <input 
                    type="text" 
                    name="query" 
                    class="search" 
                    placeholder="Какая вакансия вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>
        </div>

        @if(isset($vacancies))
        <div class="vacancies" id="vacancies">
            <div class="v-grid">

                @php

                function getWord($number, $variants) {
                    $cases = array (2, 0, 1, 1, 1, 2);
                    $index = ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)];
                    return $variants[$index];
                }

                function getDayWord($days) {
                    $lastDigit = $days % 10;
                    if ($days >= 11 && $days <= 14) {
                        return 'дней';
                    } elseif ($lastDigit == 1) {
                        return 'день';
                    } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
                        return 'дня';
                    } else {
                        return 'дней';
                    }
                }

                function getWeekWord($weeks) {
                    $lastDigit = $weeks % 10;
                    if ($weeks >= 11 && $weeks <= 14) {
                        return 'недель';
                    } elseif ($lastDigit == 1) {
                        return 'неделю';
                    } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
                        return 'недели';
                    } else {
                        return 'недель';
                    }
                }

                function getMonthWord($months) {
                    $lastDigit = $months % 10;
                    if ($months >= 11 && $months <= 14) {
                        return 'месяцев';
                    } elseif ($lastDigit == 1) {
                        return 'месяц';
                    } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
                        return 'месяца';
                    } else {
                        return 'месяцев';
                    }
                }
                @endphp

                @forelse($vacancies as $index => $vacancy)

                @php
                $now = \Carbon\Carbon::now();
                $created = \Carbon\Carbon::parse($vacancy->created_at);
                $diffInSeconds = $created->diffInSeconds($now);
                $diffInMinutes = $created->diffInMinutes($now);
                $diffInHours = $created->diffInHours($now);
                $diffInDays = $created->diffInDays($now);
                $diffInWeeks = $created->diffInWeeks($now);
                $diffInMonths = $created->diffInMonths($now);
                @endphp

                <div class="v-card" style="--i: {{ $index + 4 }}">
                    <a href="/vacancy_detail/{{ $vacancy->id }}" class="l1-data">
                        
                        <div class="cover">
                            <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                        </div>

                        <div class="text-content">
                            <h3>{{ $vacancy->title }}</h3>

                            @if($vacancy->salary_from && $vacancy->salary_to)
                                    <p>{{ $vacancy->salary_from }} — {{ $vacancy->salary_to }}₽</p>
                            @elseif($vacancy->salary_from)
                                    <p>от {{ $vacancy->salary_from }}₽</p>
                            @elseif($vacancy->salary_to)
                                    <p>до {{ $vacancy->salary_to }}₽</p>
                            @else
                                    <p>Не указана</p>
                            @endif
                        </div>

                    </a>
                        
                    <div class="l2-data">
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                            {{ $vacancy->company }}
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="icon">
                            {{ $vacancy->city }}
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="icon">
                            @if($vacancy->experience <= 0)
                                Без опыта
                            @else
                                Опыт от {{ $vacancy->experience }} {{ getWord($vacancy->experience, ['года', 'года', 'лет']) }}
                            @endif
                        </div>
                    </div>
            
                    <div class="l3-data">
                        @auth

                        @if(auth()->user()->hasRole('applicant'))
                        <div class="actions">
                            @if(auth()->user()->responses()->where('vacancy_id', $vacancy->id)->exists())
                                <div class="hint-btn">уже откликнулись</div>
                            @else
                                <div class="fill-btn response-btn">откликнуться</div>
                            @endif
                            
                            @php
                                $isFavorite = Auth::user()->favorites()->where('id', $vacancy->id)->exists();
                            @endphp
                        
                            <div 
                            href="/vacancy/{{  $vacancy->id }}/toggle_favorite "
                            class="favorite-btn {{ $isFavorite ? 'hint-btn square-btn' : 'outline-btn square-btn' }}" 
                            data-vacancy-id="{{ $vacancy->id }}">       

                                <img id="favorite-icon" src="{{  $isFavorite ? asset('icons/gray/gem.svg') : asset('icons/black/gem.svg') }}" alt="icon">
                            </div>
                            {{-- <button class="outline-btn square-btn"><img src="{{ asset('icons/black/gem.svg') }}" alt="icon"></button> --}}
                            
                        </div>
                        @else
                        <div class="actions">
                            <div class="hint-btn">откликнуться</div>
                            <div class="hint-btn square-btn"><img src="{{ asset('icons/gray/gem.svg') }}" alt="icon"></div>
                        </div>
                        @endif

                        @endauth

                        @guest
                        <div class="actions">
                            <div class="hint-btn">откликнуться</div>
                            <div class="hint-btn square-btn"><img src="{{ asset('icons/gray/gem.svg') }}" alt="icon"></div>
                        </div>
                        @endguest

                        @if ($diffInSeconds < 60)
                            <p>{{ $diffInSeconds }} {{ getWord($diffInSeconds, ['секунда', 'секунды', 'секунд']) }} назад</p>
                        @elseif ($diffInMinutes < 60)
                            <p>{{ $diffInMinutes }} {{ getWord($diffInMinutes, ['минута', 'минуты', 'минут']) }} назад</p>
                        @elseif ($diffInHours < 24)
                            <p>{{ $diffInHours }} {{ getWord($diffInHours, ['час', 'часа', 'часов']) }} назад</p>
                        @elseif ($diffInDays < 7)
                            <p>{{ $diffInDays }} {{ getWord($diffInDays, ['день', 'дня', 'дней']) }} назад</p>
                        @elseif ($diffInDays >= 7 && $diffInMonths < 1)
                            <p>{{ $diffInWeeks }} {{ getWord($diffInWeeks, ['неделя', 'недели', 'недель']) }} назад</p>
                        @else
                            <p>{{ $diffInMonths }} {{ getWord($diffInMonths, ['месяц', 'месяца', 'месяцев']) }} назад</p>
                        @endif

                            {{-- <p>{{ $vacancy->created_at->format('d.m.Y') }}</p> --}}
                        </div>
                    </div>
                @empty
                    {{-- <p>Ничего не найдено</p> --}}
                @endforelse
            </div>       
        </div>  

        <div class="pagination">
            {{ $vacancies->links() }}
            {{-- <a href="" class="arrow-btn">
                <img src="{{ asset('icons/black/angle-left.svg') }}" alt="icon">
            </a>

            <a href="" class="page">1</a>
            <a href="" class="page">2</a>
            <a href="" class="page">3</a>
            <a href="" class="page">...</a>
            <a href="" class="page">5</a>

            <a href="" class="arrow-btn">
                <img src="{{ asset('icons/black/angle-right.svg') }}" alt="icon">
            </a> --}}
        </div>
        @endif
    </div>
            
@endsection