<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Droit\User\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'     => $faker->name,
        'email'    => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role'     => 'abonne',
        'numero'   => $faker->randomDigit
    ];
});

$factory->define(App\Droit\Code\Entities\Code::class, function (Faker\Generator $faker) {

    return [
        'code'      => $faker->randomLetter,
        'valid_at'  => \Carbon\Carbon::tomorrow()->toDateString(),
        'used'      => 1,
        'user_id'   => 1,
    ];
});


$factory->define(App\Droit\Arret\Entities\Arret::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'pid'         => 1,
        'designation' => $faker->sentence(10),
        'volume_id'   => 6,
        'groupe'      => null,
        'domain_id'   => 1,
        'page'        => $faker->randomNumber(3),
        'pub_date'    => $faker->dateTime,
        'cotes'       => 'Art. 123 al. 45',
        'sommaire'    => $faker->text(300),
        'portee'      => $faker->text(300),
        'faits'       => null,
        'considerant' => null,
        'droit'       => null,
        'conclusion'  => null,
        'note'        => null,
    ];
});