<?php

use App\Carmodel;
use Illuminate\Database\Seeder;

class CarmodelsTableSeeder extends Seeder
{
    protected $items = [

        ['A-klasse', 2],
        ['B-klasse', 2],
        ['C-klasse', 2],
        ['E-klasse', 2],
        ['S-klasse', 2],
        ['G-klasse', 2],
        ['M-klasse', 2],
        ['Camry', 3],
        ['Corolla', 3],
        ['Land Cruiser', 3],
        ['Land Cruiser Prado', 3],
        ['Prius', 3],
        ['RAV 4', 3],
        ['Tundra', 3],
        ['Yaris', 3],
        ['Focus', 9],
        ['Focus 2', 9],
        ['Focus 3', 9],
        ['Mondeo', 9],
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
