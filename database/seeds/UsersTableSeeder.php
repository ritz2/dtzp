<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'  =>1,
            'name'  =>"ritz",
            'nike_name'  =>'系统超级管理员',
            'type'  =>1,
            'google'=>'W7C52VAJFGHJGM6B',
            'email' => Str::random(10).'@gmail.com',
            'password'=> bcrypt('123qwe'),
            'status'=> 1,
            'creat_id'=> 0,
            'groups_id'=> 1,
            'privileges'=>json_encode(["*"])
        ]);
        DB::table('group_identity')->insert([
            'id'  =>1,
            'group_name'  =>'超级管理员',
            'type'  =>1,
            'description'=>'超级管理员',

            'status'=> 1,
            'creat_id'=> 1,
            'privileges'=>json_encode(["*"])
        ]);

    }
}
