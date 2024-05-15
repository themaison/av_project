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
        
            $('.delete-btn').click(function() {
                var responseId = $(this).data('response-id');
                var row = $(this).closest('.l-row');
                var avList = $('.av-list');

                $.ajax({
                    url: '/responses/delete_response/' + responseId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            if (!avList.children('.l-row')) {
                                $('<p class="hint-text">откликов нет</p>').insertBefore('.av-list');
                                avList.remove();
                            }
                        } else {
                            // Обработка ошибок
                        }
                    }
                });
            });
        
            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').fadeOut();
                $('.letter-form').fadeOut();
                $('.blur-bg').fadeOut();
            });
        
            $(document).mouseup(function (e) {
                var container = $(".av-form, .letter-form");
                if (container.has(e.target).length === 0){
                    container.fadeOut();
                    $('.blur-bg').fadeOut();
                }
            });
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
                <h3>сопроводительное письмо</h3>

                {{-- <div class="av-icon">
                    <img src="{{  asset('icons/black/hand-tap.svg') }}" alt="icon">
                </div> --}}

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
        
                        {{-- <a href="/vacancy_detail/{{ $response->vacancy->id }}" class="group-elem">
                            
                            <div class="elem">
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

                            </div>

                        </a> --}}

                        @isset($response->cover_letter)
                            <div class="hint-btn square-btn cover-letter-btn" data-letter="{{ $response->cover_letter }}">
                                <img src="{{ asset('icons/gray/newspaper.svg') }}" alt="icon">
                            </div>
                        @endisset
                        
                    </div>
        
                    @if($response->status == 'не рассмотрено')
                        <button class="outline-btn square-btn delete-btn" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
        @endif
        
    </div>

    <div class="pagination">
        {{ $responses->links() }}
    </div>

@endsection