@extends('layouts.defaultLayout')

@section("content")

	@if (count($news) === 0)
		<h1 class="not-found-news">Such news is not found</h1>
	@endif
	@foreach($news as $new)
		<div class="new-block">
			<!-- If exists img -->
			@if(count($new->images) > 1) 
					<div class="images-block">
					@foreach($new->images as $img)
						<div class="image-block">

							<img src="{{ 
								Str::contains($img, "newsImages") ? asset("storage/" . $img) : $img
							}}" alt="" class="new-img">
							
						</div>
					@endforeach
					</div>
			@elseif(count($new->images) === 1)
				<div class="image-block">

					<img src="{{ 
						Str::contains($new->images[0], "newsImages") ? asset("storage/" . $new->images[0]) : $new->images[0]
					}}" alt="" class="new-img">

				</div>
			@endif
			<h3 class="new-title">{{ $new->title }}</h3>
			<p class="new-text">{{ $new->newBody }}</p>
			@if(isset($new->created_by) && isset($new->url))
				
				<p class="new-text">Created by {{ $new->created_by }}: <a href="{{ $new->url }}" target="_blank" class="link">Read more</a></p>

			@endif
			<span class="more-text">More</span>
			<p class="hashtag">
			@foreach($new->hashtags as $hashtag)
				<a href="/?hashtag={{ $hashtag }}" class="hashtag-link link">#{{ $hashtag }}</a>
			@endforeach
			</p>
			<span class="date-new">{{ date_format(date_create($new->date), 'd-m-Y') }}</span>
		</div>
	@endforeach

@endsection
