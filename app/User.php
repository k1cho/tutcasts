<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Redis;
use App\Lesson;
use App\Series;

use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    protected $with = ['subscriptions'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'confirm_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function isConfirmed()
    {
        return $this->confirm_token == null;
    }

    public function confirm()
    {
        $this->confirm_token == null;
        $this->save();
    }

    public function isAdmin()
    {
        return in_array($this->email, config('tutcasts.administrators'));
    }

    public function completeLessonRedis($lesson)
    {
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    public function percentageCompletedForSeries($series)
    {
        $numberOfLessonsInSeries = $series->lessons->count();
        $numberOfCompletedLessons = $user->getNumberOfCompletedLessonsForASeries($series);

        return ($numberOfCompletedLessons / $numberOfLessonsInSeries) * 100;
    }

    //Redis
    public function getCompletedLessonsForASeries($series)
    {
        return Redis::smembers("user:{$this->id}:series:{$series->id}");
    }

    public function getNumberOfCompletedLessonsForASeries($series)
    {
        return count($this->getCompletedLessonsForASeries($series));
    }

    public function hasStartedSeries($series)
    {
        return $this->getNumberOfCompletedLessonsForASeries($series) > 0;
    }

    public function getCompletedLessons($series)
    {
        $completedLessons = $this->getCompletedLessonsForASeries($series);

        return collect($completedLessons)->map(function($lessonId) {
            return Lesson::find($lessonId);
        });
    }

    public function hasCompletedLesson($lesson)
    {
        return in_array($lesson->id, $this->getCompletedLessonsForASeries($lesson->series));
    }

    public function seriesBeingWatched()
    {
        $keys = Redis::keys("user:{$this->id}:series:*");
        $seriesIds = [];

        foreach ($keys as $key) {
            $seriesId = explode(':', $key)[3];
            array_push($seriesIds, $seriesId);
        }

        return $seriesCollection = collect($seriesIds)->map(function ($id) {
            return Series::find($id);
        })->filter();
    }

    public function getTotalNumberOfCompletedLessons()
    {
        $keys = Redis::keys("user:{$this->id}:series:*");

        $result = 0;

        foreach ($keys as $key) {
            $result = $result + count(Redis::smembers($key));
        }

        return $result;
    }

    public function getNextLessonToWatch($series)
    {
        $lessonIds = $this->getCompletedLessonsForASeries($series);
        $lessonId = end($lessonIds);

        return Lesson::findOrfail($lessonId)->getNextLesson();
    }

    public function swapSubscriptions($request)
    {
        $userPlan = $this->subscriptions->first()->stripe_plan;

        if($request == $userPlan) {
            return redirect()->back();
        }

        $this->subscriptions()->where('stripe_plan', $userPlan)
                            ->update(['stripe_plan' => $request]);
    }
}
