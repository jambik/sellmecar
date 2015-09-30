<?php

use App\Carmodel;
use Illuminate\Database\Seeder;

class CarmodelsTableSeeder extends Seeder
{
    protected $items = [

        ['A-klasse', 1],
        ['B-klasse', 1],
        ['C-klasse', 1],
        ['E-klasse', 1],
        ['S-klasse', 1],
        ['G-klasse', 1],
        ['M-klasse', 1],
        ['Camry', 2],
        ['Corolla', 2],
        ['Land Cruiser', 2],
        ['Land Cruiser Prado', 2],
        ['Prius', 2],
        ['RAV 4', 2],
        ['Tundra', 2],
        ['Yaris', 2],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carmodels')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['name', 'car_id'], $this->items[$i]);

            Carmodel::create($row);
        }
    }
}
