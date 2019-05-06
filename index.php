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
    $tz = $airportsList[$airport2][tz];
    //$arrivalTime = $faker->dateTime('now', $tz);
    $airport1country = $airportsList[$airport1][country];
    $airport2country = $airportsList[$airport2][country]
    $airport1name = $airportsList[$airport1][name];
    $airport2name = $airportsList[$airport2][name];
    $airport1city = $airportsList[$airport1][city];
    $airport2city = $airportsList[$airport2][city];
    ob_start();


    function planeTicketGenerator($faker, $price, $flightTime, $flightTimeOptional, $departure, $arrival, $departureOptional, $arrivalOptional, $airport1, $airport2, $airportsList, $arrivalTime) {
echo <<<END
    <table>
        <tr style="background-color: #a8d8ff">
            <td colspan="3" style="text-align:left;">TICKETS IN REAL PRICE</td>
        </tr>
        <tr>
            <td style="width:220px;"></td>
            <td><img src="BoeingLogo.png" alt="BoeingLogo" style="width:200px;"/></td>
            <td><img src="AirPlaneLogo.png" alt="AirPlaneLogo" style="width:200px;"/></td>
        </tr>
        <tr style="height:50px;background-color: #93cfff;">
END;
            print("<td>From: ".$airportsList[$airport1][country].", ".$airportsList[$airport1][city]."</td>");
            print("<td>To: ".$airportsList[$airport2][country].", ".$airportsList[$airport2][city]."</td>");
            //print("<td>Arrival time: ".$arrivalTime."</td>");
echo <<<END
        </tr>
        <tr style="background-color: #93cfff;">
END;
            
            print("<td>From: ".$airportsList[$airport1][name]."</td>");
            print("<td>To: ".$airportsList[$airport2][name]."</td>");
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
            <td>Passenger surname: $faker->firstName $faker->lastName</td>
            <td>Passenger adress: $faker->streetAddress</td>
        </tr>
    </table>
END;

    }

    planeTicketGenerator($faker, $price, $flightTime, $flightTimeOptional, $departure, $arrival, $departureOptional, $arrivalOptional, $airport1, $airport2, $airportsList, $arrivalTime);
    $body = ob_get_contents();
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($body,\Mpdf\HTMLParserMode::HTML_BODY);
    ob_end_clean();
    $mpdf->Output('/home/kamil/Workspace/composer/pdf/ticket.pdf','F');

    //https://www.pasazer.com/img/images/news-old/temp/myairline.jpg?fbclid=IwAR0nJ6o8-_lIYdPzNdvZIoH7doQArY_plv4Pc5uQMgor3GZIAkqSJcZpTKE
?>

