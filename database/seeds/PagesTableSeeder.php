<?php

use App\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    protected $items = [

        ['1. Регистрация на сайте', '<p>Вам необходимо зарегистрироваться на сайте, чтобы Вы могли оставить объявление на покупку авто.</p>'],
        ['2. Какое авто хочу купить', '<p>Вы указываете все параметры автомобиля который вы хотите приобрести.</p>'],
        ['3. Продавец авто приедет к вам сам на осмотр', '<p>После того как Вы оставите объявление на сайте, потенциальне продавцы могут просматривать его.</p>'],
        ['4. Вы новый хозяин авто', '<p>Поздравляем!!! Вы новый хозяин авто.</p>'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['title', 'text'], $this->items[$i]);

            Page::create($row);
        }
    }
}
