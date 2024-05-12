@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
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
        
                $.ajax({
                    url: '/responses/delete_response/' + responseId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            row.remove();
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
            <h2>отклики</h2>
            <p>ваши отклики за последнее время</p>
        </div>

        <div class="blur-bg"></div>

        <div class="av-form" style="display: none">
            @csrf

            <div class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </div>

            <div class="form-title">
                <h3>Сопроводительно письмо</h3>

                <div class="av-icon">
                    <img src="{{  asset('icons/black/hand-tap.svg') }}" alt="icon">
                </div>

            </div>

            <p></p>

        </div>
        
        @if($responses->isEmpty())
            <p class="hint-text">откликов нет</p>
        @else
        <div class="av-list">
            @foreach($responses as $response)
                <div class="l-row">
                    <div class="set">
                        <div class="elem">
                            <p class="hint-text">{{ $response->created_at }}</p>
                        </div>
        
                        <div class="elem">
                            <p class="{{ $response->status == 'не рассмотрено' ? 'stat0' : ($response->status == 'принят' ? 'stat1' : 'stat2') }}">
                                {{ $response->status }}
                            </p>
                        </div>
        
                        <a href="/vacancy_detail/{{ $response->vacancy->id }}" class="group-elem">
                            <div class="elem">
                                @if($response->vacancy->cover)
                                    <div class="cover">
                                        <img src="{{ Storage::url($response->vacancy->cover) }}" alt="cover">
                                    </div>
                                @else
                                    <div class="cover"></div>
                                @endif
                                <p>{{ $response->vacancy->title }}</p>
                            </div>
        
                            <div class="elem">
                                <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                                <p>{{ $response->vacancy->company }}</p>
                            </div>
                        </a>
                        @isset($response->cover_letter)
                            <div class="fill-btn square-btn secondary-btn cover-letter-btn" data-letter="{{ $response->cover_letter }}">
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