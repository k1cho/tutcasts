<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Series;
use App\Lesson;


class WatchSeriesController extends Controller
{
    public function index(Series $series)
    {
        $user = auth()->user();

        if($user->hasStartedSeries($series)) {
            return redirect()
                ->route('series.watch', 
                            [
                                'series' => $series->slug, 
                                'lesson' => $user->getNextLessonToWatch($series)
                            ]
                        ); 
        }
        
        return redirect()
                ->route('series.watch', 
                            [
                                'series' => $series->slug, 
                                'lesson' => $series->lessons->first()->id
                            ]
                        ); 
    }

    public function show(Series $series, Lesson $lesson)
    {
        $user = auth()->user();

        if(!$user->subscribed('plan_E3D09nsxZZSsZS') && !$user->subscribed('plan_E3Cz1UsJCprWWt') && $lesson->premium != 1) {
            return redirect('subscribe');
        }

        return view('watch', [
            'series' => $series,
            'lesson' => $lesson
        ]);
    }

    public function completeLesson(Lesson $lesson)
    {
        auth()->user()->completeLessonRedis($lesson);

        return response()->json([ 'status' => 'ok' ]);
    }
}
