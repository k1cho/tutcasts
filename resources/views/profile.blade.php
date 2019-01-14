@extends('layouts.app')

@section('content')
<section id="intro" class="c759AAB" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
            <div class="carousel-container">
                <div class="carousel-content" style="height: 55%">
                    <h2><strong>{{ $user->name }}</strong></h2>
                    <h4 class="white">{{ $user->username}}</h4>
                    <hr class="hr">
                    <h3 class="white"><strong>{{ $user->getTotalNumberOfCompletedLessons() }}</strong></h3>
                    <p>Lessons Completed</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section" style="padding-top: 2rem;">
    <div class="container-fluid black">
        <header class="section-header">
            <hr class="hr">
            <h2 class="white">Series being watched...</h2>
            <hr class="hr">
        </header>

        <div class="row gap-5">
            <div class="col-12 mb-30">
                @foreach($series as $s)
                <h4 class="white">
                    {{$s->title}}
                    @auth
                    @hasStartedSeries($s)
                    <a href="{{ route('series.learning', $s->slug) }}" style="float:right;">Continue Learning</a>
                    @else
                    <a href="{{ route('series.learning', $s->slug) }}">Start Learning</a>
                    @endhasStartedSeries
                    @endauth
                </h4>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-fluid black">
        <header class="section-header">
            <hr class="hr">
            <h2 class="white">Edit Profile</h2>
            <hr class="hr">
            <p class="lead">Sneak peek of the lessons already available in this course</p>
        </header>
        <div class="row gap-y">
            <div class="col-12 offset-md-2 col-md-8 mb-30">
                <p class="text-center white">
                    test
                </p>
            </div>
        </div>
        <br>

        <header class="section-header">
            <hr class="hr">
            <h2 class="white">Payment & Subscriptions</h2>
            <hr class="hr">
            @if($user->subscriptions->first()->stripe_plan == 'plan_E3Cz1UsJCprWWt')
            <p class="lead">Your current plan: <button class="btn btn-outline-light">Yearly</button></p>
            @else
            <p class="lead">Your current plan: <button class="btn btn-outline-light">Monthly</button></p>
            @endif
        </header>
        <div class="row gap-y">
            <div class="col-12 offset-md-2 col-md-8 mb-30">
                <p class="text-center white">
                    <form action="{{ route('subscriptions.change') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <select name="plan" class="form-control">
                                <option value="plan_E3D09nsxZZSsZS">Monthly</option>
                                <option value="plan_E3Cz1UsJCprWWt">Yearly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-outline-success sharp" type="submit">Change Plan</button>
                        </div>

                    </form>
                </p>
            </div>
        </div>
        <br>

        <header class="section-header">
            <hr class="hr">
            <h2 class="white">Edit </h2>
            <hr class="hr">
            <p class="lead">edit </p>
        </header>
        <div class="row gap-y">
            <div class="col-12 offset-md-2 col-md-8 mb-30">
                <p class="text-center white">
                    test
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
