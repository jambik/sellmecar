<?php

use App\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $settings = new Settings();
        $settings->email       = 'jambik@gmail.com';
        $settings->description = 'Уникальность нашего сайта состоит в том, что покупатель выставляет свое объявление, а продавец автомобиля ищет именно то, объявление, где есть сходство с его автомобилем!';
        $settings->save();
    }
}
