<?php

use App\Carinfo;
use Illuminate\Database\Seeder;

class CarinfoTableSeeder extends Seeder
{
    protected $items = [

        [1, 3, 1, 1, 1, 6, 10, 20, 2, 1],
        [3, 2, 0, 3, 1, 2, 20, 0, 0, 0],
        [4, 0, 0, 0, 0, 0, 0, 20, 0, 0],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carinfo')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['car_id', 'gear', 'transmission', 'engine', 'rudder', 'color', 'capacity_from', 'capacity_to', 'state', 'owners'], $this->items[$i]);

            CarInfo::create($row);
        }
    }
}
