<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            'name' => 'admin',
            'role_id' => 1,
            'email' => 'admin@email.com',
            'password' => '$2y$10$otyg9tULr2fQUjpA1Y0li.kAdVXdUysf0zrERfKz.Wdoc.PYdfF02', //admin
            'phone' => '089876543210',
            'created_at' => Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        User::insert([
            'name' => 'user1',
            'role_id' => 2,
            'email' => 'user1@email.com',
            'password' => '$2y$10$SP5H.INRWZyKT5KN3czi7.k09rAAJwhX/oZ6Smaq0uAVIqNc8dLxi', //password
            'phone' => '089876543210',
            'created_at' => Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}
