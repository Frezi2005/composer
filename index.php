<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    </head>
</html>

<?php
    // require the Faker autoloader
    require_once 'vendor/fzaninotto/faker/src/autoload.php';
    require_once __DIR__ . '/vendor/autoload.php';
    // alternatively, use another PSR-4 compliant autoloader

    // use the factory to create a Faker\Generator instance
    $faker = Faker\Factory::create();
    // $date = new DateTime('now');
    // $now = $date->format('Y-m-d H:i:s');
    $startDeparture = strtotime("10 September 2009");
    $endDeparture = strtotime("10 July 2010");
    $startArrival = strtotime("30 September 2010");
    $endArrival = strtotime("15 July 2011");
    $departureOptional = date('Y-m-d', mt_rand($startDeparture, $endDeparture));
    $arrivalOptional = date('Y-m-d', mt_rand($startArrival, $endArrival));
    $departure = $faker->date;
    $arrival = $faker->date;
    $price = rand(100, 4000);
    $flightTime = abs(strtotime($departure) - strtotime($arrival));
    $flightTime = $flightTime/(60 * 60);
    $flightTimeOptional = abs(strtotime($departureOptional) - strtotime($arrivalOptional));
    $flightTimeOptional = $flightTimeOptional/(60 * 60);
    $list = file_get_contents("airports.json");
    $airportsList = json_decode($list, true);
    $airport1 = rand(0, count($airportsList) - 1);
    $airport2 = rand(0, count($airportsList) - 1);

    function planeTicketGenerator($faker, $price, $flightTime, $flightTimeOptional, $departure, $arrival, $departureOptional, $arrivalOptional, $airport1, $airport2, $airportsList) {
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
END;
            print("<td>".$airportsList[$airport1][country].", ".$airportsList[$airport1][city]."</td>");
            print("<td>".$airportsList[$airport2][country].", ".$airportsList[$airport2][city]."</td>");
echo <<<END
            <td></td>
        </tr>
        <tr style="background-color: #93cfff;">
END;

            print("<td>".$airportsList[$airport1][name]."</td>");
            print("<td>".$airportsList[$airport2][name]."</td>");
            echo "<td>Price: $price $faker->currencyCode</td>
        </tr>
        <tr style='background-color: #93cfff;height:50px;'>";

        if ($departure < $arrival) {
            echo "<td>Departure: $departure</td>";
            echo "<td>Arrival: $arrival</td>";
            echo "<td>Flight time(in Hours): $flightTime</td>";
        } else {
            echo "<td>Departure: $departureOptional</td>";
            echo "<td>Arrival: $arrivalOptional</td>";
            echo "<td>Flight time(in Hours): $flightTimeOptional</td>";
        }
echo <<<END
        </tr>
        <tr>
            <td>Flight with the airline: Ryanair</td>
            <td colspan="2">Passenger surname: $faker->firstName $faker->lastName</td>
        </tr>
    </table>
END;

    }

    planeTicketGenerator($faker, $price, $flightTime, $flightTimeOptional, $departure, $arrival, $departureOptional, $arrivalOptional, $airport1, $airport2, $airportsList);

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

