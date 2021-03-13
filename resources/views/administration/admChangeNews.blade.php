@extends('layouts.adminDefaultLayout')

@section("title")
    Changing a news 
@endsection

@section("content")
    <style>
        


    </style>

    <form action="{{ route('administration.update', ['id' => $new->id]) }}" class="adm-form form-add-news" method="POST">
        @csrf
        @method("PUT")
        @if(count($new->images) > 0) 
			@foreach($new->images as $key => $img)
				<a href="{{ route('administration.del-img', ['elId' => $new->id, 'imgId' => $key]) }}" class="image-delete">
					<img src="{{ $img }}" alt="" class="update-img">
				</a>
			@endforeach
		@endif

        <label for="images" class="adm-form-label add-news-label">Add images</label>
        <input type="file" name="images" id="images" class="adm-form-input adm-input-file">

        <label for="title" class="adm-form-label add-news-label">Enter title</label>
        <input type="text" name="title" id="title" value="{{ $new->title }}" class="adm-form-input">

        <label for="newBody" class="adm-form-label add-news-label">Enter text for news</label>
        <textarea name="newBody" id="newBody" cols="50" class="adm-form-input" rows="10">{{ $new->newBody }}</textarea>

        <label for="hashtags" class="adm-form-label add-news-label">Enter hashtags through space and without "#"</label>
        <input type="text" name="hashtags" value="{{ $hashtag }}" id="hashtags" class="adm-form-input">

        <label for="date" class="adm-form-label add-news-label">Enter date</label>
        <input type="text" name="date" value="{{ $new->date }}" id="date" class="adm-form-input">

        <button type="submit" class="adm-form-btn">Change a news</button>
    </form>

@endsection