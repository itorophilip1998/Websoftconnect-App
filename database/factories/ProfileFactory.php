<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;



$factory->define(Profile::class, function (Faker $faker)  {
    return [
        'user_id' => factory(App\User::class),
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'phone' => "000-000-000",
        'field' => 'No field',
        'dob' => now(),
        'country' =>' ',
        'city' => ' ',
        'photo' => URL::to('/storage/photos/avater.png'),
         'status' => $faker->paragraph,
    ];
});
