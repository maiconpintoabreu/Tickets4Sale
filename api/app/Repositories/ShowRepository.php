<?php

namespace App\Repositories;

use App\Show;
use App\ShowByDay;
use Carbon\CarbonImmutable;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class ShowRepository
{
    /**
     * Get all of the tasks for a given show.
     *
     * @param  Show  $show
     * @return Collection
     */
    public function create($show)
    {
        $show = Show::create($show);
        $showByDay = [];
        $startDay = CarbonImmutable::create($show->start_at->year,$show->start_at->month,$show->start_at->day);
        for ($i=0; $i < 60; $i++) {
            array_push($showByDay, ShowRepository::getShowByDayItem($show, 200,10, 0, $startDay->addDays($i)));
        }
        for ($i=60; $i < 80; $i++) {
            array_push($showByDay, ShowRepository::getShowByDayItem($show, 100,5, 0, $startDay->addDays($i)));
        }
        for ($i=80; $i < 100; $i++) {
            array_push($showByDay, ShowRepository::getShowByDayItem($show, 100,5, 20, $startDay->addDays($i)));
        }
        $show->showByDay()->createMany($showByDay);
        echo "..";
    }
    public function getShowByDayItem(Show $show, $capacity,$ticketsAvailable, $discountPercentage, $startDay)
    {
        return [
            'capacity'=> $capacity,
            'tickets_available'=> $ticketsAvailable,
            'discount_percentage'=> $discountPercentage,
            'show_id'=> $show->id,
            'show_date'=> $startDay,
        ];
    }
}