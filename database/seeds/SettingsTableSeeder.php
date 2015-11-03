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
        $settings->description = 'Описание сайта';
        $settings->save();
    }
}
