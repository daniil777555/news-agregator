@extends('layouts.adminDefaultLayout')

@section("title")
    Chose news for update 
@endsection

@section("content")

    @csrf
    @foreach($news as $key => $new)
        <div class="change-news-block">
            <a href="{{ route('administration.show', ['id' => $key]) }}" class="link-news-to-update">
                {{ $new->title }} {{ $new->date }}
            </a> 
            <button value="{{ $new->id }}" class="delete-news">X</button> 
        </div>
    @endforeach

    <script src="{{ asset('js/administration.js') }}"></script>

@endsection

