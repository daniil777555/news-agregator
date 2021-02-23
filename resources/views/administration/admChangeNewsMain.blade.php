@extends('layouts.adminDefaultLayout')

@section("title")
    Chose news for update 
@endsection

@section("content")

    @foreach($news as $key => $new)
        <div class="change-news-block">
            <a href="{{ route('administration.show', ['id' => $key]) }}" class="link-news-to-update">
                {{ $new['title'] }} {{ $new['date'] }}
            </a> 
            
            {{-- Тут почему-то не происходит переход на destroy, а наоборот переходит на show--}}
            <a href="{{ route('administration.destroy', ['id' => $key]) }}" class="delete-news">X</a>
        </div>
    @endforeach

