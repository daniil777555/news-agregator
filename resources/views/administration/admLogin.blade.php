@extends('layouts.adminDefaultLayout')

@section("title")
    Login
@endsection

@section("content")

    <form action="#" class="adm-form" method="post">
        @csrf
        <label for="admLogin" class="adm-form-label">Enter your login</label>
        <input type="text" name="admLogin" id="admLogin" class="adm-form-input">

        <label for="admPass" class="adm-form-label">Enter your passward</label>
        <input type="password" name="admPass" id="admPass" class="adm-form-input">

        <button type="submit" class="adm-form-btn">Sign in</button>
    </form>

@endsection