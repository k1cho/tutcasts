@extends('layouts.app')

@section('content')
<section id="intro" class="c6772e5" style="margin-top: -2rem; height: 30rem;">
    <div class="intro-container">
        <div id="introCarousel">
            <div class="carousel-container">
                <div class="carousel-content" style="height: 55%">
                    <h2><strong>Stripe Checkout</strong></h2>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section" style="padding-top: 2rem;">
    <div class="container-fluid black" style="height:30rem">
        <header class="section-header">
            <h2 class="white text-center">Checkout</h2>
            <hr class="hr">
        </header>

        <div class="row gap-5">
            <div class="col-12 mb-30">
              <vue-stripe email="{{ auth()->user()->email }}"></vue-stripe>
            </div>
        </div>
    </div>
</section>

@endsection
