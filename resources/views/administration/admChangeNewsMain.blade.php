@extends('layouts.adminDefaultLayout')

@section("title")
    Сhoose news for update 
@endsection

@section("content")

    @csrf
    @foreach($news as $key => $oneNews)
        <div class="change-news-block">
            <a href="{{ route('administration.show', ['id' => $key]) }}" class="link-news-to-update">
                {{ $oneNews->title }} {{ $oneNews->date }}
            </a>
            @if(in_array("D", session("status")))
                <button value="{{ $oneNews->id }}" class="delete-news">X</button>
            @endif  
        </div>
    @endforeach

    <script src="{{ asset('js/administration.js') }}"></script>

@endsection

