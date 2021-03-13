@extends('layouts.adminDefaultLayout')

@section("title")
    Login
@endsection

@section("content")

    <form action="{{ route('administration.login') }}" class="adm-form" method="POST">
        @csrf
        <label for="login" class="adm-form-label">Enter your login</label>
        <input type="text" name="login" id="admLogin" class="adm-form-input">

        <label for="pass" class="adm-form-label">Enter your passward</label>
        <input type="password" name="pass" id="admPass" class="adm-form-input">

        <button type="submit" class="adm-form-btn">Sign in</button>
    </form>

@endsection