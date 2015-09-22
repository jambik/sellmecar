<?php

use App\Car;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Mercedes-Benz', 'mercedes_benz.png'],
        [2, 'Toyota', 'toyota.png'],
        [3, 'Volkswagen', 'volkswagen.png'],
        [4, 'BMW', 'bmw.png'],
        [5, 'Hyundai', 'hyundai.png'],
        [6, 'Audi', 'audi.png'],
        [7, 'Renault', 'renault.png'],
        [8, 'Ford', 'ford.png'],
        [9, 'Mazda', 'mazda.png'],
        [10, 'Mitsubishi', 'mitsubishi.png'],
        [11, 'Peugeot', 'peugeot.png'],
        [12, 'Chevrolet', 'chevrolet.png'],
        [13, 'KIA', 'kia.png'],
        [14, 'Volvo', 'volvo.png'],
        [15, 'Nissan', 'nissan.png'],
        [16, 'Opel', 'opel.png'],
        [17, 'Lexus', 'lexus.png'],
        [18, 'Skoda', 'skoda.png'],
        [19, 'Land Rover', 'land_rover.png'],
        [20, 'Honda', 'honda.png'],
        [21, 'Hummer', 'hummer.png'],
        [22, 'Citroen', 'citroen.png'],
        [23, 'Jeep', 'jeep.png'],
        [24, 'Jaguar', 'jaguar.png'],
        [25, 'Infinity', 'infiniti.png'],
        [26, 'Subaru', 'subaru.png'],
        [27, 'Seat', 'seat.png'],
        [28, 'Porshe', 'porsche.png'],
        [29, 'FIAT', 'fiat.png'],
        [30, 'Alfa Romeo', 'alfa_romeo.png'],
        [31, 'MINI', 'mini.png'],
        [32, 'Ferrari', 'ferrari.png']

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['id', 'name', 'image'], $this->items[$i]);

            Car::create($row);
        }
    }
}
