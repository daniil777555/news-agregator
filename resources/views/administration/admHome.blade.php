@extends('layouts.adminDefaultLayout')

@section("title")
    Home 
@endsection

@section("content")
    <div class="adm-block-link">
        <a href="{{ route('administration.create') }}" class="home-adm-link">Add</a>
        <a href="{{ route('administration.change') }}" class="home-adm-link">Change</a>
        <a href="{{ route('administration.upload') }}" class="home-adm-link">Upload data from other resource</a>
    </div>

@endsection