<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Prepare admin account
        $userAdmin['name'] = "geozzaadmin";
        $userAdmin['password'] = bcrypt("geozzaadmin123");
        $userAdmin['email'] = "admin@gmail.com";
        // $userAdmin['no_telp'] = "1080-2307-821";
        User::create($userAdmin);

        DB::table('users')->insert([
            'name' => "geozzaadmin",
            'email' => Str::random(10).'@example.com',
            'password' => bcrypt("geozzaadmin123"),
        ]);
    }
}
