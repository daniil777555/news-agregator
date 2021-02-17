@extends('layouts.adminDefaultLayout')

@section("title")
    Home 
@endsection

@section("content")
    <div class="adm-block-link">
        <a href="{{ route('administration.add') }}" class="home-adm-link">Add</a>
        <a href="{{ route('administration.change') }}" class="home-adm-link">Change</a>
    </div>

@endsection