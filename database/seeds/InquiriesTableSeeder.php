<?php

use App\Inquiry;
use Illuminate\Database\Seeder;

class InquiriesTableSeeder extends Seeder
{
    protected $items = [

        [1, 1, 'C-Classe', 1, 1000000, 1400000, 2010, 2013, 'Москва', 'Динамо', 'Динамовская улица', 'Джанбулат Магомаев', '+79034297801', 'не битую'],
        [1, 1, 'S-Classe', 1, 2000000, 2900000, 2013, 2015, 'Санкт-Петербург', 'Достоевская', 'улица Достоевского', 'Джанбулат', '', 'цвет нужен белый или серебристый'],
        [2, 2, 'Camry', 2, 800000, 900000, 2012, 2013, 'Москва', 'Арбатская', 'улица Арбат', 'Сергей Иванов', '', 'желательно черную'],
        [2, 8, 'Focus 3', 0, 1000000, 1200000, 2013, 2015, 'Москва', 'Борисово', 'Борисовский проезд', 'Сергей', '+79286573498', ''],
        [1, 1, 'C-Classe', 1, 1000000, 1400000, 2010, 2013, 'Москва', 'Динамо', 'Динамовская улица', 'Джанбулат Магомаев', '+79034297801', 'не битую'],
        [1, 1, 'S-Classe', 1, 2000000, 2900000, 2013, 2015, 'Санкт-Петербург', 'Достоевская', 'улица Достоевского', 'Джанбулат', '', 'цвет нужен белый или серебристый'],
        [2, 2, 'Camry', 2, 800000, 900000, 2012, 2013, 'Москва', 'Арбатская', 'улица Арбат', 'Сергей Иванов', '', 'желательно черную'],
        [2, 8, 'Focus 3', 0, 1000000, 1200000, 2013, 2015, 'Москва', 'Борисово', 'Борисовский проезд', 'Сергей', '+79286573498', ''],
        [1, 1, 'C-Classe', 1, 1000000, 1400000, 2010, 2013, 'Москва', 'Динамо', 'Динамовская улица', 'Джанбулат Магомаев', '+79034297801', 'не битую'],
        [1, 1, 'S-Classe', 1, 2000000, 2900000, 2013, 2015, 'Санкт-Петербург', 'Достоевская', 'улица Достоевского', 'Джанбулат', '', 'цвет нужен белый или серебристый'],
        [2, 2, 'Camry', 2, 800000, 900000, 2012, 2013, 'Москва', 'Арбатская', 'улица Арбат', 'Сергей Иванов', '', 'желательно черную'],
        [2, 8, 'Focus 3', 0, 1000000, 1200000, 2013, 2015, 'Москва', 'Борисово', 'Борисовский проезд', 'Сергей', '+79286573498', ''],
        [1, 1, 'C-Classe', 1, 1000000, 1400000, 2010, 2013, 'Москва', 'Динамо', 'Динамовская улица', 'Джанбулат Магомаев', '+79034297801', 'не битую'],
        [1, 1, 'S-Classe', 1, 2000000, 2900000, 2013, 2015, 'Санкт-Петербург', 'Достоевская', 'улица Достоевского', 'Джанбулат', '', 'цвет нужен белый или серебристый'],
        [2, 2, 'Camry', 2, 800000, 900000, 2012, 2013, 'Москва', 'Арбатская', 'улица Арбат', 'Сергей Иванов', '', 'желательно черную'],
        [2, 8, 'Focus 3', 0, 1000000, 1200000, 2013, 2015, 'Москва', 'Борисово', 'Борисовский проезд', 'Сергей', '+79286573498', ''],
        [1, 1, 'C-Classe', 1, 1000000, 1400000, 2010, 2013, 'Москва', 'Динамо', 'Динамовская улица', 'Джанбулат Магомаев', '+79034297801', 'не битую'],
        [1, 1, 'S-Classe', 1, 2000000, 2900000, 2013, 2015, 'Санкт-Петербург', 'Достоевская', 'улица Достоевского', 'Джанбулат', '', 'цвет нужен белый или серебристый'],
        [2, 2, 'Camry', 2, 800000, 900000, 2012, 2013, 'Москва', 'Арбатская', 'улица Арбат', 'Сергей Иванов', '', 'желательно черную'],
        [2, 8, 'Focus 3', 0, 1000000, 1200000, 2013, 2015, 'Москва', 'Борисово', 'Борисовский проезд', 'Сергей', '+79286573498', ''],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiries')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['user_id', 'car_id', 'model', 'transmission', 'price_from', 'price_to', 'year_from', 'year_to', 'city', 'metro', 'street', 'name', 'phone', 'information'], $this->items[$i]);

            Inquiry::create($row);
        }
    }
}
