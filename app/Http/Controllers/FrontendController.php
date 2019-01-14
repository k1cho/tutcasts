<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Series;

class FrontendController extends Controller
{
    public function index()
    {
        return view('home')->withSeries(Series::latest()->get());
    }

    public function series(Series $series)
    {
        return view('series')->withSeries($series);
    }
}
