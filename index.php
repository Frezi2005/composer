<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    </head>
</html>

<?php
    // require the Faker autoloader
    require_once 'vendor/fzaninotto/faker/src/autoload.php';
    // alternatively, use another PSR-4 compliant autoloader

    // use the factory to create a Faker\Generator instance
    $faker = Faker\Factory::create();
    $date = new DateTime('now');
    $now = $date->format('Y-m-d H:i:s');
    $departure = $faker->date;
    //$arrival = $departure + 6;
    $price = rand(100, 4000);
    //$flightTime = $faker->dateTimeBetween($startDate = '$departure', $endDate = '$arrival', $timezone = null);

    function planeTicketGenerator($faker, $now, $price) {
echo <<<END
    <table>
        <tr style="background-color: #a8d8ff">
            <td colspan="3" style="text-align:left;">TICKETS IN REAL PRICE</td>
        </tr>
        <tr>
            <td style="width:200px;"></td>
            <td><img src="BoeingLogo.png" alt="BoeingLogo" style="width:200px;"/></td>
            <td><img src="AirPlaneLogo.png" alt="AirPlaneLogo" style="width:200px;"/></td>
        </tr>
        <tr style="height:50px;background-color: #93cfff;">
            <td>From: $faker->city</td>
            <td>To: $faker->city</td>
            <td></td>
        </tr>
        <tr style="background-color: #93cfff;">
            <td>XXX</td>
            <td>XXX</td>
            <td>XXX</td>
        </tr>
        <tr style="background-color: #93cfff;">
            <td colspan="2">Departure: $faker->date</td>
            <td>Price: $price PLN</td>
        </tr>
        <tr>
            <td>Flight with the airline: Ryanair</td>
            <td colspan="2">Passenger surname: $faker->firstName $faker->lastName</td>
        </tr>
    </table>
END;
    }

    planeTicketGenerator($faker, $now, $price);

    // $now
    //     <br />
    //     From: $faker->city To: $faker->city 
    //     <br />
    //     Departure: $faker->date Arrival: $faker->date
    //     <br />
    //     Name: $faker->firstName Surname: $faker->lastName
    //     <br />
    //     Adress: $faker->streetAddress
    //     <br />
    //     Price: $price
?>

