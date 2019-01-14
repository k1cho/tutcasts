@extends('layouts.app')

@section('content')
<section id="intro" class="c846A6A" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
            <div class="carousel-container">
                <div class="carousel-content" style="height: 55%;">
                    <h2><strong>{{ $lesson->title }}</strong></h2>
                    <p class="fs-20 opacity-70">
                        {{ $series->title }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="section bg-grey">
    <div class="container-fluid black">

        @php
        $nextLesson = $lesson->getNextLesson();
        $prevLesson = $lesson->getPrevLesson();
        @endphp

        <div class="row gap-y">
            <div class="col-12">
                <div class="col-8 offset-2">
                    <vue-player default_lesson="{{ $lesson }}" @if ($nextLesson->id !== $lesson->id) next_lesson_url="{{ route('series.watch', 
                                                [ 
                                                    'series' => $series->slug, 
                                                    'lesson' => $nextLesson->id 
                                                ]) 
                                            }}"
                        @endif>
                    </vue-player>
                    <div class="next-prev-lessons">
                        @if ($prevLesson->id !== $lesson->id)
                        <a href="{{ route('series.watch', [ 'series' => $series->slug, 'lesson' => $prevLesson->id ]) }}"
                            class="btn btn-info white sharp" style="float: left">Previous Lesson</a>
                        @endif
                        @if ($nextLesson->id !== $lesson->id)
                        <a href="{{ route('series.watch', [ 'series' => $series->slug, 'lesson' => $nextLesson->id ]) }}"
                            class="btn btn-info white sharp" style="float: right">Next Lesson</a>
                        @endif
                    </div>
                </div>
                <div class="col-8 offset-2">
                    <ul class="list-group">
                        @foreach ($series->getOrderedLessons() as $l)
                        <li class="list-group-item
                        @if ($l->id == $lesson->id)
                            active
                        @endif
                        ">
                            <a href="{{ route('series.watch', [ 'series' => $series->slug, 'lesson' => $l->id ]) }}">
                                <strong>{{ $l->title }}</strong>
                            </a>
                            @if (auth()->user()->hasCompletedLesson($l))
                            <b>
                                <i class="material-icons" style="float:right;">
                                    check_circle_outline
                                </i>
                            </b>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
    .next-prev-lessons {
        width: 1034px;
        display: inline-block;
        overflow: auto;
        white-space: nowrap;
        margin-top: 5px;
        margin-bottom: 20px;
    }

</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
