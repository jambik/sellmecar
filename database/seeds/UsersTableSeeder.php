<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Джанбулат Магомаев', 'jambik@gmail.com', '', 'https://graph.facebook.com/v2.4/1130016013694031/picture?type=normal', 'facebook', '1130016013694031'],
        [2, 'Сергей Иванов', 'jambik-m@yandex.ru', '', 'https://graph.facebook.com/v2.4/126370007717655/picture?type=normal', 'facebook', '126370007717655'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for($i=0; $i<count($this->items); $i++)
        {
            $row = array_combine(['id', 'name', 'email', 'phone', 'avatar', 'provider', 'provider_id'], $this->items[$i]);

            User::create($row);
        }
    }
}
