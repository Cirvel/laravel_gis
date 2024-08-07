<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    // Prepare admin account
    $userAdmin['name'] = "geozzaadmin";
    $userAdmin['password'] = bcrypt("geozzaadmin123");
    $userAdmin['email'] = "admin@gmail.com";
    // $userAdmin['no_telp'] = "1080-2307-821";
    User::create($userAdmin);

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
