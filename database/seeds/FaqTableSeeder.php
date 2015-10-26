<?php

use Illuminate\Database\Seeder;
use App\Faq;

class FaqTableSeeder extends Seeder
{
    protected $items = [

        [1, '������ 1', '<p>����� 1</p>'],
        [2, '������ 2', '<p>����� 2</p>'],

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

            //Faq::create($row);
        }
    }
}
