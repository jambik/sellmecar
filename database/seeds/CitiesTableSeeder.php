<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Москва'],
        [2, 'Санкт-Перербург'],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['id', 'name'], $this->items[$i]);

            City::create($row);
        }
    }
}
