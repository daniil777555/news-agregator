@extends('layouts.defaultLayout')

@section("content")

	@if (count($news) === 0)
		<h1 class="not-found-news">Such news is not found</h1>
	@endif
	@foreach($news as $new)
		<div class="new-block">
			<!-- If exists img -->
			@if(count($new["images"]) > 1) 
					<div class="images-block">
					@foreach($new["images"] as $img)
						<div class="image-block">
							<img src="{{ $img }}" alt="" class="new-img">
						</div>
					@endforeach
					</div>
			@elseif(count($new["images"]) === 1)
				<div class="image-block">
					<img src="{{ $new['images'][0] }}" alt="" class="new-img">
				</div>
			@endif
			<h3 class="new-title">{{ $new["title"] }}</h3>
			<p class="new-text">{{ $new["newBody"] }}</p>
			<span class="more-text">More</span>
			<p class="hashtag">
			@foreach($new["hashtags"] as $hashtag)
				<a href="/?hashtag={{ $hashtag }}" class="hashtag-link">#{{ $hashtag }}</a>
			@endforeach
			</p>
			<span class="date-new">{{ $new["date"] }}</span>
		</div>
	@endforeach

@endsection
