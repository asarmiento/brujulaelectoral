<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crea usuario administrador
        DB::table('users')->insert([
            'name' => 'administrador',
            'email' => 'redaccion@planv.com.ec',
            'password' => bcrypt('$M!Uj6#Xh='),
        ]);
    }
}
