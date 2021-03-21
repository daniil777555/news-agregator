@extends('layouts.adminDefaultLayout')

@section("title")
    Adding a new news 
@endsection

@section("content")

    <form action="{{ route('administration.store') }}" class="adm-form form-add-news" enctype="multipart/form-data" method="POST">
        @csrf
        <label for="images" class="adm-form-label add-news-label">Add images</label>
        <input type="file" name="images" id="images" class="adm-form-input adm-input-file">

        <label for="title" class="adm-form-label add-news-label">Enter title</label>
        <input type="text" name="title" id="title" class="adm-form-input">

        <label for="newBody" class="adm-form-label add-news-label">Enter text for news</label>
        <textarea name="newBody" id="newBody" cols="50" class="adm-form-input" rows="10"></textarea>

        <label for="hashtags" class="adm-form-label add-news-label">Enter hashtags through the "|" and without "#"</label>
        <input type="text" name="hashtags" id="hashtags" class="adm-form-input hashtags">

        <label for="date" class="adm-form-label add-news-label">Enter date</label>
        <input type="text" name="date" id="date" value="{{ date("d.m.Y") }}" class="adm-form-input">

        <button type="submit" class="adm-form-btn">Add new news</button>
    </form>

@endsection

@push('js')
    <script>
        ClassicEditor
            .create( document.querySelector( '#newBody' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush