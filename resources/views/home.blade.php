@extends('layouts.defaultLayout')

@section("content")

	<style>



	</style>

	@if (count($news) === 0)
		<h1 class="not-found-news">Such news is not found</h1>
	@endif

	@foreach($news as $oneNews)
		<div class="oneNews-block">

			<div class="images-block-wrapper">

				<div class="slider-btn-wrapper slider-btn-none">
					<button class="slider-btn  left"><i class="fas fa-chevron-left"></i></button>
				</div>

				<div class="images-block {{ count($oneNews->images) > 1 ? "many-images" : "" }}">
					@foreach($oneNews->images as $key => $img)
						<div class="image-block 
							{{ $key === 0 && count($oneNews->images) > 1  ? "image-block-1" : ""}}
							{{ count($oneNews->images) === 2 && $key === 0 ? "image-block-two-el" : "" }}
							{{ $key > 3  ? "hiden-image-block" : ""}}
						">
						
							<img src="{{ 
								Str::contains($img, "newsImages") ? asset("storage/" . $img) : $img
							}}" alt="" class="news-img">
							
						</div>
					@endforeach
					
				</div>

				<div class="slider-btn-wrapper slider-btn-none">
					<button class="slider-btn right"><i class="fas fa-chevron-right"></i></button>
				</div>

			</div>
			@if(count($oneNews->images) - 4 > 0)
				<p class="sub"><sub>+{{ count($oneNews->images) - 4 }}</sub></p>
			@endif

			<h3 class="news-title">{{ $oneNews->title }}</h3>
			<p class="news-text">{{ $oneNews->newBody }}</p>

			@if(isset($oneNews->created_by) && isset($oneNews->url))
				
				<p class="news-text">Created by {{ $oneNews->created_by }}: <a href="{{ $oneNews->url }}" target="_blank" class="link">Read more</a></p>

			@endif

			<span class="more-text">More</span>
			<p class="hashtag">

			@if(count($oneNews->hashtags) > 1) 
				@foreach($oneNews->hashtags as $hashtag)
					<a href="/?hashtag={{ $hashtag }}" class="hashtag-link link">#{{ $hashtag }}</a>
				@endforeach
			@endif

			</p>
			<span class="date-news">{{ date_format(date_create($oneNews->date), 'd-m-Y') }}</span>
		</div>

	@endforeach

@endsection
