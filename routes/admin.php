<?php

Route::resource('series', 'SeriesController');
Route::resource('series/{series_by_id}/lessons', 'LessonsController');