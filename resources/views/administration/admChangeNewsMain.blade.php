@extends('layouts.adminDefaultLayout')

@section("title")
    Chose news for update 
@endsection

@section("content")

    @foreach($news as $key => $new)
        <div class="change-news-block">
            <a href="{{ route('administration.changeNews', ['id' => $key]) }}" class="link-news-to-update">
                {{ $new['title'] }} {{ $new['date'] }}
            </a> 
            <a href="{{ route('administration.delete', ['id' => $key]) }}" class="delete-news">X</a>
        </div>
    @endforeach

@endsection