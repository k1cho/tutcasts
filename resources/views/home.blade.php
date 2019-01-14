@extends('layouts.app')

@section('content')
<div class="container">
    @forelse ($series as $s)
    <div class="row">
        <div class="card box">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $s->image_path }}" class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                    <h5><strong><a href="{{ route('series', $s->slug) }}">{{ $s->title }}</a></strong></h5>
                        <p>{{ $s->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>No content yet.</h1>
        </div>
    </div>
    @endforelse
</div>
@endsection
