@extends('layouts.app')

@section('content')

<section id="intro" class="c2F4858" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
            <div class="carousel-container">
                <div class="carousel-content" style="height: 55%">
                    <h1 class="display-4 white">Edit: <strong>{{ $series->title }}</strong></h1>
                    <p class="lead white">Let's make the world a better place for coders</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid black">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('series.update', $series->slug) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <input value="{{ $series->title }}" type="text" class="form-control sharp" name="title" id="title"
                        placeholder="Enter Title">
                </div>
                <div class="form-group">
                    <textarea class="form-control sharp" name="description" id="description" cols="30" rows="5"
                        placeholder="Enter Description">{{ $series->description }}</textarea>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control sharp" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary sharp">Update Series</button>
            </form>
        </div>
    </div>
</div>
@endsection
