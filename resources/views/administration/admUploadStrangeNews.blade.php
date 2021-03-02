@extends('layouts.adminDefaultLayout')

@section("title")
    Upload
@endsection

@section("content")
    <form action="#" class="adm-form" method="POST">
        @csrf
        <label for="link" class="adm-form-label">Enter link</label>
        <input type="text" name="link" id="link" class="adm-form-input">

        <label for="desc" class="adm-form-label">Enter description</label>
        <input type="text" name="desc" id="desc" class="adm-form-input">

       <button type="submit" class="adm-form-btn">Upload</button>
    </form>

@endsection