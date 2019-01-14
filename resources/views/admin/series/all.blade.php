@extends('layouts.app')

@section('content')

<section id="intro" class="purple" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
            <div class="carousel-container">
                <div class="carousel-content" style="height: 55%">
                    <h1 class="display-4 white">All TutCasts series</h1>
                    <p class="lead white">Let's make the world a better place for coders</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid black">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <th class="white">Title</th>
                    <th class="white">Show</th>
                    <th class="white">Edit</th>
                    <th class="white">Delete</th>
                </thead>
                <tbody>
                    @forelse ($series as $s)
                    <tr>
                        <td class="white">{{ $s->title }}</td>
                        <td class="white">
                            <a href="{{ route('series.show', $s->slug) }}" class="btn btn-info btn-sm sharp">Show</a>
                        </td>
                        <td class="white">
                            <a href="{{ route('series.edit', $s->slug) }}" class="btn btn-primary btn-sm sharp">Edit</a>
                        </td>
                        <td class="white">
                            <a href="{{ route('series.destroy', $s->id) }}" class="btn btn-danger btn-sm sharp">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <p class="text-center white">No Series yet</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
