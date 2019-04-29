<?php
    // require the Faker autoloader
    require_once 'vendor/fzaninotto/faker/src/autoload.php';
    // alternatively, use another PSR-4 compliant autoloader

    // use the factory to create a Faker\Generator instance
    $faker = Faker\Factory::create();
    $date = new DateTime('now');
    $now = $date->format('Y-m-d H:i:s');
    $wylot = $faker->date;
    //$przylot = $wylot + 6;

    function planeTicketGenerator($faker, $now) {
echo <<<END
        $now
        <br />
        From: $faker->country, $faker->city To: $faker->country, $faker->city 
        <br />
        Wylot: $faker->date Przylot: $faker->date


END;
    }

    planeTicketGenerator($faker, $now);

?>