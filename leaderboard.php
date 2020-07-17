<?php
    session_start();

    include "./connect.php";

    // Hier wordt connectie gemaakt met de database
    $mysql = mysqli_connect($server,$user,$pass,$db) or die("Fout: Er is geen verbinding met de MySQL-server tot stand gebracht!");
    
    // Gegevens opvragen uit de database, per moeilijkheidsgraad een andere leaderboard
    $moeilijkheidsgraad = $_SESSION["moeilijkheidsgraad"];
    $resultaat = mysqli_query($mysql,"SELECT username, score FROM spelers WHERE moeilijkheidsgraad='$moeilijkheidsgraad' ORDER BY score ASC LIMIT 3;") or die("De selectquery op de database is mislukt!");
    mysqli_close($mysql) or die("Het verbreken van de verbinding met de MySQL-server is mislukt!");
    
    $count = 1;
        while(list($username,$score) = mysqli_fetch_row($resultaat)) {
            echo "<div id='p$count' class='user'>
            <div class='place'>#$count</div> 
            <div class='username'>$username</div> 
            <div class='score'>$score</div>
            </div>";
            $count++;
        }
?>