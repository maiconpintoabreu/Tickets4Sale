<?php

namespace App\Repositories;

use App\Show;
use App\ShowByDay;

class ShowByDayRepository
{
    public function byDate($date)
    {
        return ShowByDay::with('show')->where('show_date', $date)
                    ->orderBy('id', 'asc')
                    ->get();
    }
}