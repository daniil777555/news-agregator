@extends('layouts.adminDefaultLayout')

@section("title")
    Changing a news 
@endsection

@section("content")

    <form action="{{ route('administration.update', ['id' => $oneNews->id]) }}" class="adm-form form-add-news" enctype="multipart/form-data" method="POST">
        @csrf
        @method("PUT")
        @if(count($oneNews->images) > 0)
            <div class="change-news-image-block">
                @foreach($oneNews->images as $key => $img)
                    <a href="{{ route('administration.del-img', ['elId' => $oneNews->id, 'imgId' => $key]) }}" class="image-delete">
                        
                        <img src="{{ 
                            Str::contains($img, "newsImages") ? asset("storage/" . $img) : $img
                        }}" alt="" class="update-img">
                        
                    </a>
                @endforeach
            </div> 
		@endif

        <label for="images" class="adm-form-label add-news-label">Add images</label>
        <input type="file" name="images" id="images" class="adm-form-input adm-input-file">

        <label for="title" class="adm-form-label add-news-label">Enter title</label>
        <input type="text" name="title" id="title" value="{{ $oneNews->title }}" class="adm-form-input">

        <label for="newBody" class="adm-form-label add-news-label">Enter text for news</label>
        <textarea name="newBody" id="newBody" cols="50" class="adm-form-input" rows="10">{{ $oneNews->newBody }}</textarea>

        <label for="hashtags" class="adm-form-label add-news-label">Enter hashtags through the "|" and without "#"</label>
        <input type="text" name="hashtags" value="{{ $hashtag }}" id="hashtags" class="adm-form-input hashtags">

        <label for="date" class="adm-form-label add-news-label">Enter date</label>
        <input type="text" name="date" value="{{ date_format(date_create($oneNews->date), 'd-m-Y') }}" id="date" class="adm-form-input">

        <button type="submit" class="adm-form-btn">Change a news</button>
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