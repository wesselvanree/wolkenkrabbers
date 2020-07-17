<?php
// overal waar je bij de sessie variabelen wilt komen moet dit staan
session_start();

if (!isset($_SESSION["moeilijkheidsgraad"])) {
    // moeilijkheidsgraad staat standaard op easy, door het woord "normal" hieronder aan te passen naar "hard" of "easy" verandert 
    $_SESSION["moeilijkheidsgraad"] = "normal";
    
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
        $_SESSION["moeilijkheidsgraad"] = "normal";
        $_SESSION["bord"] = [[[-1],[0,1,2,4],[0,1,1,3],[0,1,0,3],[0,1,0,3],[0,1,0,2],[0,1,0,1],[-1]],
                            [[0,1,0,6],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,5],[0,0,0,0],[0,1,0,1]],
                            [[0,1,0,2],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,2]],
                            [[0,1,0,2],[0,0,0,0],[1,0,0,6],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,3],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[1,0,0,1],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,2],[0,0,0,0],[0,0,0,0],[1,0,0,4],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,3]],
                            [[0,1,0,1],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,1,0,4]],
                            [[-1],[0,1,0,1],[0,1,0,2],[0,1,0,3],[0,1,0,2],[0,1,0,2],[0,1,0,6],[-1]]];
    }
}
// Hier worden de verbindingsgegevens opgehaald
include "./connect.php";

// Hier wordt connectie gemaakt met de database
$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

// Gegevens opvragen uit de database
$moeilijkheidsgraad = $_SESSION["moeilijkheidsgraad"];
$resultaat = mysqli_query($mysql,"SELECT username, score FROM spelers WHERE moeilijkheidsgraad='$moeilijkheidsgraad' ORDER BY score ASC LIMIT 3;") or die("De selectquery op de database is mislukt!");
mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

// voor versturen van formulier wanneer er gewonnen is
if(isset($_POST["submit"]))
{
// Hier wordt connectie gemaakt met de database
$mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");

// Hier worden de ingevulde gegevens veilig opgehaald uit het formulier
$score = $_SESSION['beurten'];
$naam =  mysqli_real_escape_string($mysql,$_POST['naam']);
$moeilijkheidsgraad = $_SESSION["moeilijkheidsgraad"];

// omdat het formulier verzonden wordt, wordt het bord weer gereset
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

// Gegevens in de database zetten
mysqli_query($mysql,"INSERT INTO `wolkenkrabbers`.`spelers` (`id`, `username`, `score`, `moeilijkheidsgraad`) VALUES (NULL, '$naam', '$score', '$moeilijkheidsgraad')") or die("De selectquery op de database is mislukt!");
mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");

// omdat er een post request verstuurd is kan de gebruiker als hij het tabblad ververst dezelfde data nog een keer sturen, daarom wordt de user naar deze pagina geredirect maar dan is het een GET request en zijn en geen POST variabelen meer
header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wolkenkrabbers 2.0</title>
    <link rel="stylesheet" href="./css/main.css" type="text/css" />
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />
</head>
<body>
    <div class="title">
        <h1>Wolkenkrabbers 2.0</h1>
        <div class="title_links">
            <p class="view_leaderboard">View Leaderboard</p><span> | </span>
            <p class="easy <?php if($_SESSION["moeilijkheidsgraad"] == "easy") {echo "active";} ?>">Easy</p><span> | </span>
            <p class="normal <?php if($_SESSION["moeilijkheidsgraad"] == "normal") {echo "active";} ?>">Normal</p><span> | </span>
            <p class="hard <?php if($_SESSION["moeilijkheidsgraad"] == "hard") {echo "active";} ?>">Hard</p><span> | </span>
        </div>
    </div>
    
    <main>
        <!-- omdat de POST request doo middel van javascript verzonden zullen worden hoeft hier geen formulier te zijn -->
        <div id="spelbord"></div>
          
        <!-- Leaderboard is voor connectie maken met database -->
        <div class="leaderboard">
            <h1>Leaderboard</h1>
            <?php
                // laat de gegevens zien uit de query bovenaan
                $count = 1;
                while(list($username,$score, $moeilijkheidsgraad) = mysqli_fetch_row($resultaat)) {
                	  echo "<div id='p$count' class='user'>
                	    <div class='place'>#$count</div> 
                	    <div class='username'>$username</div> 
                	    <div class='score'>$score</div>
                	</div>";
                    $count++;
                }
            ?>
        </div>
            
        <p class="reset">reset</p>
    </main>
    <div class="close_leaderboard"></div>
    
    <script type="text/javascript" src="./js/script.js"></script>
</body>
</html>