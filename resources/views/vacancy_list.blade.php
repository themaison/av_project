@extends('layouts.layout')

@section('title', 'запрос')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/vacancy_list.css?v=').time()}}" rel="stylesheet">
 
    <div class="content">
        <div class="search-box">
            @if(isset($vacancies) && $vacancies->count() > 0)
                <h2  style="--i: 0">«{{ $query }}»</h2>
                <p  style="--i: 1">найдено <span>{{ $vacancies->count() }} вакансий</span></p>
            @else
                <h2  style="--i: 0">Пусто</h2>
                <p  style="--i: 1">по запросу ничего не найдено</span></p>
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
                @forelse($vacancies as $index => $vacancy)
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
                                    Опыт от {{ $vacancy->experience }} лет
                                @endif
                            </div>
                        </div>
            
                        <div class="l3-data">
                            <div class="actions">
                                <button class="fill-btn">откликнуться</button>
                                <button class="outline-btn square-btn"><img src="{{ asset('icons/black/gem.svg') }}" alt="icon"></button>
                            </div>
                            <p>{{ $vacancy->created_at->format('d.m.Y') }}</p>
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