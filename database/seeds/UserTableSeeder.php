<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\User::create([
          'name' => 'Admin da Silva',
          'email' => 'admin@gmail.com.br',
          'password' => bcrypt('123456')
        ]);
    }
}
