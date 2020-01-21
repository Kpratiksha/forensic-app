<?php


$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\ContactUsRecords::class, function (Faker\Generator $faker) {
    return [
        'fullname' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'message' => $faker->paragraphs(1),
       // 'remember_token' => str_random(10),
    ];
});