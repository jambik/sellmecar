<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PagesTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(CarsTableSeeder::class);
        $this->call(CarmodelsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(MetroTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InquiriesTableSeeder::class);
        $this->call(CarinfoTableSeeder::class);

        Model::reguard();
    }
}
