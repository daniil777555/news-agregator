@extends('layouts.adminDefaultLayout')

@section("title")
    Upload
@endsection

@section("content")
    <form action="{{ route('administration.addingLink') }}" class="adm-form" method="POST">
        @csrf
        <label for="link" class="adm-form-label">Enter link</label>
        <input type="text" name="link" id="link" class="adm-form-input">

       <button type="submit" class="adm-form-btn">Upload</button>
    </form>

@endsection