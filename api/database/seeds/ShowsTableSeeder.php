<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Repositories\ShowRepository;

class ShowsTableSeeder extends Seeder
{
    protected $show;
    public function __construct(ShowRepository $show)
    {
        $this->show = $show;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('show_by_day')->delete();
        DB::table('shows')->delete();
        $file_n = Storage::disk('local')->path('shows.csv');
        $file = fopen($file_n, "r");
        $all_data = array();
        $format = 'd/m/Y';
        while ( ($data = fgetcsv($file, 200, ",")) !==FALSE) {
            if($data[0] != ""){
                $date = Carbon::createFromFormat($format, $data[1]);
                $this->show->create([
                    'title' =>  $data[0],
                    'start_at' => $date,
                    'genre' => $data[2]
                ]);
            }
        }
        fclose($file);
    
    }
}
