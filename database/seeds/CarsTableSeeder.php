<?php

use App\Car;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    protected $items = [

        [1, 1, 'ВАЗ', 'vaz.png'],

        [2, 0, 'Mercedes-Benz', 'mercedes_benz.png'],
        [3, 0, 'Toyota', 'toyota.png'],
        [4, 0, 'Volkswagen', 'volkswagen.png'],
        [5, 0, 'BMW', 'bmw.png'],
        [6, 0, 'Hyundai', 'hyundai.png'],
        [7, 0, 'Audi', 'audi.png'],
        [8, 0, 'Renault', 'renault.png'],
        [9, 0, 'Ford', 'ford.png'],
        [10, 0, 'Mazda', 'mazda.png'],
        [11, 0, 'Mitsubishi', 'mitsubishi.png'],
        [12, 0, 'Peugeot', 'peugeot.png'],
        [13, 0, 'Chevrolet', 'chevrolet.png'],
        [14, 0, 'KIA', 'kia.png'],
        [15, 0, 'Volvo', 'volvo.png'],
        [16, 0, 'Nissan', 'nissan.png'],
        [17, 0, 'Opel', 'opel.png'],
        [18, 0, 'Lexus', 'lexus.png'],
        [19, 0, 'Skoda', 'skoda.png'],
        [20, 0, 'Land Rover', 'land_rover.png'],
        [21, 0, 'Honda', 'honda.png'],
        [22, 0, 'Hummer', 'hummer.png'],
        [23, 0, 'Citroen', 'citroen.png'],
        [24, 0, 'Jeep', 'jeep.png'],
        [25, 0, 'Jaguar', 'jaguar.png'],
        [26, 0, 'Infinity', 'infiniti.png'],
        [27, 0, 'Subaru', 'subaru.png'],
        [28, 0, 'Seat', 'seat.png'],
        [29, 0, 'Porshe', 'porsche.png'],
        [30, 0, 'FIAT', 'fiat.png'],
        [31, 0, 'Alfa Romeo', 'alfa_romeo.png'],
        [32, 0, 'MINI', 'mini.png'],
        [33, 0, 'Ferrari', 'ferrari.png'],
        [34, 0, 'Acura', 'acura.png'],
        [35, 0, 'Aston Martin', 'aston_martin.png'],
        [36, 0, 'Bentley', 'bentley.png'],
        [37, 0, 'Bugatti', 'bugatti.png'],
        [38, 0, 'Buick', 'buick.png'],
        [39, 0, 'Cadillac', 'cadillac.png'],
        [40, 0, 'Chery', 'chery.png'],
        [41, 0, 'Chrysler', 'chrysler.png'],
        [42, 0, 'Dodge', 'dodge.png'],
        [43, 0, 'Lamborghini', 'lamborghini.png'],
        [44, 0, 'Lifan', 'lifan.png'],
        [45, 0, 'Saab', 'saab.png'],
        [46, 0, 'Smart', 'smart.png'],
        [47, 0, 'SsangYong', 'ssangyong.png'],
        [48, 0, 'Suzuki', 'suzuki.png'],

        [49, 1, 'ГАЗ', 'gaz.png'],
        [50, 1, 'ИЖ', 'izh.png'],
        [51, 1, 'УАЗ', 'uaz.png'],

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
            $row = array_combine(['id', 'domestic', 'name', 'image'], $this->items[$i]);

            Car::create($row);
        }
    }
}
