<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'adminapp',
            'email' => 'admin@app.co.id',
            'roles'=> 'ADMIN',
            'password' => Hash::make('adminapp'),
        ]);
    }
}
