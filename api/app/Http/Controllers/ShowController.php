<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ShowByDayRepository;
use Carbon\CarbonImmutable;
class ShowController extends Controller
{
    protected $showByDayRepository;
    public function __construct(ShowByDayRepository $showByDayRepository)
    {
        $this->showByDayRepository = $showByDayRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $showDate = CarbonImmutable::parse($request->query('show-date'));
        $queryDate = CarbonImmutable::today();
        $list = $this->showByDayRepository->byDate($showDate);
        $diff = $showDate->diffInDays()+1;

        foreach ($list as $show) {
            $show->tickets_left = 0;
            if ($queryDate->gt($showDate)) {
                $show->tickets_available = 0;
                $show->status = "In the past";
            } else if($diff > 25) {
                $show->status = "Sale not started";
            } else {
                $show->status = "Open for sale";
                if($show->capacity == 200){
                    $show->tickets_left = $show->capacity - (10*(25-$diff)); 
                }else{
                    $show->tickets_left = $show->capacity - (5*(25-$diff)); 
                }
                if($show->tickets_left <= 0){
                    $show->tickets_available = 0;
                    $show->tickets_left = 0;
                    $show->status = "Sold out";
                }else if($show->tickets_left < $show->tickets_available){
                    $show->tickets_available = $show->tickets_left;
                }
            }
            ShowController::generatePrice($show);
        }
        return response()
        ->json(['inventory' => [
            ["genre"=> "musical", "shows"=>$list->where("show.genre","Musical")->values()],
            ["genre"=> "comedy", "shows"=>$list->where("show.genre","Comedy")->values()],
            ["genre"=> "drama", "shows"=>$list->where("show.genre","Drama")->values()]
        ] ]);
    }
    public function generatePrice($show){
        $show->price = 70;
        if($show->genre == "Musical"){
            $show->price = 50;
        }else if($show->genre == "Drama"){
            $show->price = 40;
        }
        $show->price = $show->price - ($show->price * ($show->discount_percentage / 100));
    }
}
