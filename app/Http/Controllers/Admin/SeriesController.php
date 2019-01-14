<?php

namespace App\Http\Controllers\Admin;

use App\Series;
use App\Http\Requests\CreateSeriesRequest;
use App\Http\Requests\UpdateSeriesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::latest()->get();
        return view('admin.series.all')->withSeries($series);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeriesRequest $request)
    {
        return $request->uploadSeriesImage()
                ->storeSeries();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        //dd($series);
        return view('admin.series.index')->withSeries($series);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit')->withSeries($series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeriesRequest $request, Series $series)
    {
        $request->updateSeries($series);

        session()->flash('succes', 'Series successfully updated.');

        return redirect()->route('series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
