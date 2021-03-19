@extends('layouts.adminDefaultLayout')

@section("title")
    Home 
@endsection

@section("content")
    <div class="adm-block-link">
        <a href="{{ route('administration.create') }}" class="home-adm-link">Add</a>
        <a href="{{ route('administration.change') }}" class="home-adm-link">Change</a>
        <a href="{{ route('administration.addURL') }}" class="home-adm-link">Add url</a>
        <a href="{{ route('administration.logs') }}" class="home-adm-link">Logs</a>
        <a href="{{ route('administration.startParsing') }}" class="home-adm-link">Start parsing</a>
    </div>

@endsection