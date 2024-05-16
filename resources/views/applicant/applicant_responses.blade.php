@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/applicant_responses.css?v=').time()}}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('.cover-letter-btn').click(function() {
                var letter = $(this).data('letter');
                $('.av-form p').text(letter);
                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
            });
        
            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').fadeOut();
                $('.letter-form').fadeOut();
                $('.blur-bg').fadeOut();
            });
        
            // $(document).mouseup(function (e) {
            //     var container = $(".av-form, .letter-form");
            //     if (container.has(e.target).length === 0){
            //         container.fadeOut();
            //         $('.blur-bg').fadeOut();
            //     }
            // });
        });
    </script>     

    <div class="content">

        <div class="title">
            <h2 style="--i: 0">отклики</h2>
            <p style="--i: 1">ваши отклики за последнее время</p>
        </div>

        <div class="blur-bg"></div>

        <div class="av-form" style="display: none">
            @csrf

            <div class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </div>

            <div class="form-title">
                <h3>Сопр. письмо</h3>

                <div class="av-icon">
                    <img src="{{ asset('icons/black/newspaper.svg') }}" alt="icon">
                </div>

            </div>

            <p></p>

        </div>
        
        @if($responses->isEmpty())
            <p class="hint-text" style="--i: 2">откликов нет</p>
        @else
        <div class="av-list" style="--i: 3">
            @foreach($responses as $index => $response)
                <div class="l-row" style="--i: {{ $index + 3 }}">
                    <div class="set">
                        <div class="elem">
                            <p class="hint-text">{{ $response->created_at }}</p>
                        </div>
        
                        <div class="elem">
                            <p class="{{ $response->status == 'не рассмотрено' ? 'stat0' : ($response->status == 'принят' ? 'stat1' : 'stat2') }}">
                                {{ $response->status }}
                            </p>
                        </div>

                        <a href="/vacancy_detail/{{ $response->vacancy->id }}" class="elem">
                            @if($response->vacancy->cover)
                                <div class="cover">
                                    <img src="{{ Storage::url($response->vacancy->cover) }}" alt="cover">
                                </div>
                            @else
                                <div class="cover"></div>
                            @endif
                            <p>{{ $response->vacancy->title }}</p>
                            
                            <div class="icon-block">
                                <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                                <p>{{ $response->vacancy->company }}</p>
                            </div>

                        </a>

                        @isset($response->cover_letter)
                            <div class="hint-btn square-btn cover-letter-btn" data-letter="{{ $response->cover_letter }}">
                                <img src="{{ asset('icons/gray/newspaper.svg') }}" alt="icon">
                            </div>
                        @endisset
                        
                    </div>
        
                    @if($response->status == 'не рассмотрено')
                        <form action="/responses/delete_response/{{ $response->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" outline-btn delete-btn square-btn">
                                <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                            </button>
                        </form>

                        {{-- <button class="outline-btn square-btn delete-btn" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                        </button> --}}
                    @endif
                </div>
            @endforeach
        </div>

        <div class="pagination" style="--i: 3">
            {{ $responses->links() }}
        </div>
        @endif
        
    </div>

@endsection