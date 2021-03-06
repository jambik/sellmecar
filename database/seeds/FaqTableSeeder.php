<?php

use Illuminate\Database\Seeder;
use App\Faq;

class FaqTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Какие премиальные марки авто быстрее теряют в цене?', '<p>Lexus — теряет в цене меньше всего, далее идет Инфинити, потом немецкие бренды Audi, mercedes-benz, BMW.</p><p>И вообще, чем дороже машина, тем больше она теряет в цене, особенно немецких это касается.</p><p>Из непримиальных Тойота например теряет в цене не сильно, в частности если за два миллиона рублей и выше, то это Ленд Крузер, или Хайлендер. BMW X5, ML, Q5 Q7 — быстрее теряют в цене</p>'],
        [2, 'Какой расход топлива у Infiniti QX70 (FX)?', '<p>У меня дизельный вариант 3.0 литра, Расход 7.2 трасса, 11.5 город. Стиль езды обычный, бодрый)) 550н/м к этому располагает.<br></p>'],
        [3, 'Что означает название Audi TT?', '<p>Аббревиатура TT расшифровывается Tourist Trophy — именно такое название имеет ежегодная гонка, которая проводится с далекого 1905 года в Великобритании. В честь этой гонки и был назван данный спортивный автомобиль.<br></p>'],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['id', 'question', 'answer'], $this->items[$i]);

            Faq::create($row);
        }
    }
}
