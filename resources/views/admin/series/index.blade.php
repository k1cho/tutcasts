@extends('layouts.app')

@section('content')

<section id="intro" class="c36213E" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
            <div class="carousel-container">
                <div class="carousel-content" style="height: 55%">
                        <h1 class="display-4 white">{{ $series->title }}</h1>
                        <p class="lead white">Customize your series lessons</p>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="jumbotron jumbotron-fluid black justify-content-center">
    <div class="container">
        <div class="col-12 white">
            <vue-lessons default_lessons="{{ json_encode($series->lessons) }}" series_id="{{ $series->id }}"></vue-lessons>
        </div>
    </div>
</div>
@endsection
