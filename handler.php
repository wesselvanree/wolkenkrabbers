<?php
    session_start();

    if (!isset($_SESSION["fout"])) {

        // *UPDATE* om het iets makkelijker te maken hebben we een aparte array gemaakt voor het rood maken van de binnenste elementen
        $_SESSION["fout"] = [[0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0]];

        // oplossing (normal)

        // van elk element: [te veranderen of niet, binnenkant of buitenkant, niks/rood/groen, waarde]
        // [[[-1],[0,1,2,4],[0,1,1,3],[0,1,0,3],[0,1,0,3],[0,1,0,2],[0,1,0,1],[-1]],
        //                 [[0,1,0,6],[0,0,0,1],[0,0,0,2],[0,0,0,3],[0,0,0,4],[1,0,0,5],[0,0,0,6],[0,1,0,1]],
        //                 [[0,1,0,2],[0,0,0,4],[0,0,0,3],[0,0,0,1],[0,0,0,2],[0,0,0,6],[0,0,0,5],[0,1,0,2]],
        //                 [[0,1,0,2],[0,0,0,3],[1,0,0,6],[0,0,0,5],[0,0,0,1],[0,0,0,2],[0,0,0,4],[0,1,0,3]],
        //                 [[0,1,0,3],[0,0,0,2],[0,0,0,4],[0,0,0,6],[0,0,0,5],[1,0,0,1],[0,0,0,3],[0,1,0,3]],
        //                 [[0,1,0,2],[0,0,0,5],[0,0,0,1],[1,0,0,4],[0,0,0,6],[0,0,0,3],[0,0,0,2],[0,1,0,3]],
        //                 [[0,1,0,1],[0,0,0,6],[0,0,0,5],[0,0,0,2],[0,0,0,3],[0,0,0,4],[0,0,0,1],[0,1,0,4]],
        //                 [[-1],[0,1,0,1],[0,1,0,2],[0,1,0,3],[0,1,0,2],[0,1,0,2],[0,1,0,6],[-1]]];
    }

    if (!isset($_SESSION["beurten"])) { // als de beurten nog niet werden bijhegouden is die nu 1
        $_SESSION["beurten"] = 1;
    } if (isset($_POST['reset']) && $_POST['reset'] == "ja") { // zodra er een post request door middel van AJAX is verstuurd met de variabele 'reset', wordt de sessie gestopt
        session_destroy();
    } if (isset($_POST["moeilijkheidsgraad"])) {
    $_SESSION["moeilijkheidsgraad"] = $_POST["moeilijkheidsgraad"];
    $_SESSION["beurten"] = 0;
    if ($_SESSION["moeilijkheidsgraad"] == "easy") {

        $_SESSION["bord"] = [[[-1],[0,1,0,6],[0,1,0,3],[0,1,0,3],[0,1,0,2],[0,1,0,2],[0,1,0,1],[-1]],
                            [[0,1,0,6],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,1]],
                            [[0,1,0,4],[0,0,0,0],[1,0,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,5],[0,1,0,2]],
                            [[0,1,0,2],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,5],[0,0,0,0],[0,0,0,0],[0,1,0,4]],
                            [[0,1,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,2],[0,0,0,0],[1,0,0,4],[0,0,0,0],[0,0,0,0],[1,0,0,6],[0,0,0,0],[0,1,0,2]],
                            [[0,1,0,1],[0,0,0,0],[0,0,0,0],[1,0,0,5],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[-1],[0,1,0,1],[0,1,0,4],[0,1,0,2],[0,1,0,3],[0,1,0,2],[0,1,0,3],[-1]]];
    } else if ($_SESSION["moeilijkheidsgraad"] == "hard") {
        $_SESSION["bord"] = [[[-1],[0,1,0,3],[0,1,0,3],[0,1,0,2],[0,1,0,1],[0,1,0,2],[0,1,0,4],[-1]],
                            [[0,1,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,2],[1,0,0,5],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,2]],
                            [[0,1,0,1],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,2]],
                            [[0,1,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,1]],
                            [[0,1,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,6],[0,0,0,0],[0,1,0,2]],
                            [[0,1,0,2],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,4]],
                            [[-1],[0,1,0,2],[0,1,0,1],[0,1,0,3],[0,1,0,2],[0,1,0,2],[0,1,0,3],[-1]]];
    } else {
        $_SESSION["bord"] = [[[-1],[0,1,2,4],[0,1,1,3],[0,1,0,3],[0,1,0,3],[0,1,0,2],[0,1,0,1],[-1]],
                            [[0,1,0,6],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,5],[0,0,0,0],[0,1,0,1]],
                            [[0,1,0,2],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,2]],
                            [[0,1,0,2],[0,0,0,0],[1,0,0,6],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,1],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,2],[0,0,0,0],[0,0,0,0],[1,0,0,4],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,1],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,4]],
                            [[-1],[0,1,0,1],[0,1,0,2],[0,1,0,3],[0,1,0,2],[0,1,0,2],[0,1,0,6],[-1]]];
    }
    echo "reload";
} else {
        $_SESSION["beurten"] = $_SESSION["beurten"] + 1;

        // als er een waarde ingevoerd is wordt deze aangepast
        if (isset($_POST["locatie"])) {
            $row = (int)$_POST["locatie"][0];
            $column = (int)$_POST["locatie"][1];
            $waarde = (int)$_POST["value"];

            $_SESSION["bord"][$row][$column][3] = $waarde;
        }


        // checken voor zijkanten

        // links naar rechts
        for ($i = 1; $i <= 6; $i++) {
            $vorigeHoogste = 0;
            $count = 0;
            $max = $_SESSION["bord"][$i][0][3]; // waarde die het moet zijn
            for ($j = 1; $j <= 6; $j++) {
                if ($_SESSION["bord"][$i][$j][3] > $vorigeHoogste) { // als deze waarde hoger is dan de vorige: count omhoog en vorige hoogste op deze waarde zetten
                    $count = $count + 1;
                    $vorigeHoogste = $_SESSION["bord"][$i][$j][3];
                }
            }
            if ($count == $max) { // als de waarde goed is => groen, anders => rood
                $_SESSION["bord"][$i][0][2] = 2;
            } else {
                $_SESSION["bord"][$i][0][2] = 0;
            }
        }
        // de volgende doen het zelfde als hierboven maar dan de andere richtingen op
        // rechts naar links
        for ($i = 1; $i <= 6; $i++) {
            $vorigeHoogste = 0;
            $count = 0;
            $max = $_SESSION["bord"][$i][7][3];
            for ($j = 6; $j >= 1; $j--) {
                if ($_SESSION["bord"][$i][$j][3] > $vorigeHoogste) {
                    $count = $count + 1;
                    $vorigeHoogste = $_SESSION["bord"][$i][$j][3];
                }
            }
            if ($count == $max) {
                $_SESSION["bord"][$i][7][2] = 2;
            } else {
                $_SESSION["bord"][$i][7][2] = 0;
            }
        }

        // boven naar onder
        for ($i = 1; $i <= 6; $i++) {
            $vorigeHoogste = 0;
            $count = 0;
            $max = $_SESSION["bord"][0][$i][3];
            for ($j = 1; $j <= 6; $j++) {
                if ($_SESSION["bord"][$j][$i][3] > $vorigeHoogste) {
                    $count = $count + 1;
                    $vorigeHoogste = $_SESSION["bord"][$j][$i][3];
                }
            }
            if ($count == $max) {
                $_SESSION["bord"][0][$i][2] = 2;
            } else {
                $_SESSION["bord"][0][$i][2] = 0;
            }
        }

        // onder naar boven
        for ($i = 1; $i <= 6; $i++) {
            $vorigeHoogste = 0;
            $count = 0;
            $max = $_SESSION["bord"][7][$i][3];
            for ($j = 6; $j >= 1; $j--) {
                if ($_SESSION["bord"][$j][$i][3] > $vorigeHoogste) {
                    $count = $count + 1;
                    $vorigeHoogste = $_SESSION["bord"][$j][$i][3];
                }
            }
            if ($count == $max) {
                $_SESSION["bord"][7][$i][2] = 2;
            } else {
                $_SESSION["bord"][7][$i][2] = 0;
            }
        }


        // checken voor dubbelen in dezelde rij

        // alle waardes op 0 zetten zodat degene die nu niet meer oranje moeten blijven weer een normale kleur krijgen
         $_SESSION["fout"] = [[0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0],
                            [0,0,0,0,0,0]];

        for ($i = 1; $i <= 6; $i++) {
            $horizontaal = [];
            $verticaal = [];
            // array maken met alle waardes op deze row
            for ($j = 1; $j <= 6; $j++) {
                $horizontaal[$j - 1] = $_SESSION["bord"][$i][$j][3];
                $verticaal[$j - 1] = $_SESSION["bord"][$j][$i][3];
            }


            for ($j = 1; $j <= 6; $j++) {
                // count(array_keys($horizontaal, $j) geeft aan hoevaak een getal in een array voorkomt, array_keys($horizontaal, $j geeft een array terug met de indexen van de waarde $j. Count geeft het aantal waardes in een array aan
                $aantalHorizontaal = count(array_keys($horizontaal, $j));
                $aantalVerticaal = count(array_keys($verticaal, $j));
                // waardes die 1 moeten worden (dus oranje) worden 1
                if($aantalHorizontaal > 1) {
                    foreach(array_keys($horizontaal, $j) as $index) {
                        $_SESSION["fout"][$i - 1][$index] = 1;
                    }
                } if ($aantalVerticaal > 1) {
                    foreach(array_keys($verticaal, $j) as $index) {
                        $_SESSION["fout"][$index][$i - 1] = 1;
                    }
                }
            }
        }

        // voor testen van $_SESSION["fout"]
        // for ($i = 0; $i < 6; $i++) {
        //     for ($j = 0; $j < 6; $j++) {
        //         echo $_SESSION["fout"][$i][$j] . ", ";
        //     }
        //     echo "<br>";
        // }


        // check of we een winnaar hebben
        $groen = 0;
        $leeg = 0;
        $rood = 0;
        for ($i = 1; $i <= 6; $i++) {
            // boven, onder, links, rechts voor de zijkanten
            if (($_SESSION["bord"][0][$i][2] == 2) && ($_SESSION["bord"][7][$i][2] == 2) && ($_SESSION["bord"][$i][0][2] == 2) && ($_SESSION["bord"][$i][7][2] == 2)) {
                $groen = $groen + 1;
            }

            // nu nog of er overal iets ingevuld is
            for ($j = 1; $j <= 6; $j++) {
                if ($_SESSION["bord"][$i][$j][3] == 0) {
                    $leeg = $leeg + 1;
                } if ($_SESSION["fout"][$i - 1][$j - 1] == 1) {
                    $rood = $rood + 1;
                }
            }
        }

        // als niks leeg is, niets rood is en alle 6 de zijdes groen zijn heeft de speler gewonnen
        if ($groen == 6 && $leeg == 0 && $rood == 0) {
            echo "<h1 class='eindbericht'>Score: <span>" . $_SESSION['beurten'] . "</span></h1><br>
            <form action='index.php' method='POST'>
                <input class='naam' name='naam' type=text placeholder='naam...'/>
                <input class='naam_verzenden' type='submit' name='submit' value='submit' />
            </form>";
        } else { // voor als er nog geen winnaar is
            // visualiseren
            for ($i = 0; $i < 8; $i++) {
                for ($j = 0; $j < 8; $j++) {
                    if ($_SESSION["bord"][$i][$j][0] < 0) {
                        echo "<div id='$i$j' class='buitenkant onzichtbaar'></div>";
                    } else if ($_SESSION["bord"][$i][$j][1] == 1) { // buitenkant
                        // welke kleur
                        if ($_SESSION["bord"][$i][$j][2] == 2) {
                            echo "<div id='$i$j' class='buitenkant correct'>";
                        } else {
                            echo "<div id='$i$j' class='buitenkant incorrect'>";
                        }
                        echo $_SESSION["bord"][$i][$j][3]; // waarde invullen
                        echo "</div>";
                    } else if ($_SESSION["bord"][$i][$j][1] == 0) { // binnenkant
                        if ($_SESSION["bord"][$i][$j][0] == 1) { // staat vast (kan niet gewijzigd worden)
                            echo "<div id='$i$j' class='binnenkant donkerder'>";
                            echo $_SESSION["bord"][$i][$j][3];
                            echo "</div>";
                        } else {
                            $l = $_SESSION["bord"][$i][$j][3];
                            if ($_SESSION["fout"][$i - 1][$j - 1] == 1) { // als waarde verkeerd is rood maken
                                echo "<div id='$i$j' class='binnenkant incorrect'><select name=$i$j>";
                            } else {
                                echo "<div id='$i$j' class='binnenkant'><select name=$i$j>";
                            }
                            for($k = 0; $k < 7; $k++){ // options inveogen met de bijbehorende kloppende waarde
                                if ($l == $k) {
                                    echo "<option selected='selected'>$k</option>";
                                } else if ($k == 0) {
                                    echo "<option></option>";
                                } else {
                                    echo "<option>$k</option>";
                                }
                            }
                            echo "</select></div>";
                        }

                    }
                }
            }
        }
    }


?>
