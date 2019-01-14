@extends('layouts.app')

@section('content')
<section id="intro" class="c7785AC" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
                <div class="carousel-container">
                    <div class="carousel-content" style="height: 55%">
                        <h2><strong>{{ strtoupper($series->title) }}</strong></h2>
                        @auth
                            @hasStartedSeries($series)
                                <a href="{{ route('series.learning', $series->slug) }}" class="btn-get-started scrollto">Continue Learning</a>
                            @else
                                <a href="{{ route('series.learning', $series->slug) }}" class="btn-get-started scrollto">Start Learning</a>
                            @endhasStartedSeries
                        @else
                            <a href="{{ route('series.learning', $series->slug) }}" class="btn-get-started scrollto">Start Learning</a>
                        @endauth
                    </div>
                </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top: 2rem">
    <div class="container-fluid black">
        <header class="section-header">
            <small class="white"><strong>Course Description</strong></small>
            <h2 class="white">What's this course about?</h2>
            <hr>
        </header>

        <div class="row gap-y">
            <div class="col-12 offset-md-2 col-md-8 mb-30">
                <p class="text-center white">
                    {{ $series->description }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section bg-grey">
    <div class="container-fluid black">
        <header class="section-header">
            <h2 class="white">Video lessons</h2>
            <hr>
            <p class="lead">Sneak peek of the lessons already available in this course</p>
        </header>
    </div>
</section>
@endsection