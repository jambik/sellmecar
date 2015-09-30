<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Джанбулат Магомаев', 'jambik@gmail.com', '', 'https://graph.facebook.com/v2.4/1130016013694031/picture?type=normal', 'facebook', '1130016013694031'],
        [2, 'Сергей Иванов', 'jambik-m@yandex.ru', '', 'https://graph.facebook.com/v2.4/126370007717655/picture?type=normal', 'facebook', '126370007717655'],
        [3, 'Jeny Art', 'usungurov@yandex.ru', '', 'https://graph.facebook.com/v2.4/480337272127783/picture?type=normal', 'facebook', '480337272127783'],
        [4, 'sellmecar', 'sellmecar@yandex.ru', '', '', '', ''],
        [5, 'ya.sellmecar', 'ya.sellmecar@yandex.ru', '', '', '', ''],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Администратор'; // optional
        $admin->description  = ''; // optional
        $admin->save();


        DB::table('users')->delete();

        $row1 = array_combine(['id', 'name', 'email', 'phone', 'avatar', 'provider', 'provider_id'], $this->items[0]) + ['password' => bcrypt('111111')];
        $user1 = User::create($row1);

        $row2 = array_combine(['id', 'name', 'email', 'phone', 'avatar', 'provider', 'provider_id'], $this->items[1]) + ['password' => bcrypt('111111')];
        $user2 = User::create($row2);

        $row3 = array_combine(['id', 'name', 'email', 'phone', 'avatar', 'provider', 'provider_id'], $this->items[2]) + ['password' => bcrypt('zaurzaur')];
        $user3 = User::create($row3);

        $row4 = array_combine(['id', 'name', 'email', 'phone', 'avatar', 'provider', 'provider_id'], $this->items[3]) + ['password' => bcrypt('16180339887')];
        $user4 = User::create($row4);

        $row5 = array_combine(['id', 'name', 'email', 'phone', 'avatar', 'provider', 'provider_id'], $this->items[4]) + ['password' => bcrypt('16180339887')];
        $user5 = User::create($row5);

        $user1->attachRole($admin);
        $user3->attachRole($admin);
        $user4->attachRole($admin);
        $user5->attachRole($admin);
    }
}
