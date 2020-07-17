// een paar opmaak dingetjes met behulp van javascript
if (window.innerWidth < 900) {
    document.querySelector("body > main").style.transform = "scale(" + (480 / 900) + ")";
}

// tevoorschijn teveren van leaderboard
document.querySelector(".view_leaderboard").addEventListener('click', viewLeaderboard);
document.querySelector(".close_leaderboard").addEventListener('click', hideLeaderboard);

// Door middel van AJAX wordt elke keer dat er op show leaderboard geklikt wordt, de data geupdate vanuit de database
function viewLeaderboard(event) {
    // maak object aan
    const xhr = new XMLHttpRequest();

    // omdat dit asynchonous javascript is moet dit pas uitgevoederd worden als de data ontvangen is van het andere bestand
    xhr.onload = function() {
        console.log("bord geupdate");
        const leaderboard = document.querySelector(".leaderboard");
        leaderboard.innerHTML = "<h1>Leaderboard</h1>\n" + this.responseText;
        document.querySelector(".leaderboard").classList.add("leaderboard-showing");
        document.querySelector(".close_leaderboard").classList.add("close_leaderboard-active");
    };
    
    // stuur get request naar leaderboard.php, dit document stuur data over de top 3 spelers
    xhr.open("GET", "./leaderboard.php");
    xhr.send();
}

// Om het leaderboard te verbergen
function hideLeaderboard(event) {
    document.querySelector(".leaderboard").classList.add("leaderboard-hiding");
    document.querySelector(".leaderboard").classList.remove("leaderboard-showing");
    document.querySelector(".close_leaderboard").classList.remove("close_leaderboard-active");
    setTimeout(function() {
        document.querySelector(".leaderboard").classList.remove("leaderboard-hiding");
    }, 300);
}




// moeilijkheidsgraad veranderen
document.querySelector(".easy").addEventListener('click', easy);
document.querySelector(".normal").addEventListener('click', normal);
document.querySelector(".hard").addEventListener('click', hard);

function easy(event) {
    console.log("easy");
    
    // maak object aan
    const xhr = new XMLHttpRequest();
    
    // als de response van handler.php "reload" is, ververst dit de pagina zodat het nieuwe spelbord ingeladen wordt
    xhr.onload = function() {
        console.log(this.responseText);
        if (this.responseText == "reload") {
            location.reload(true);
        }
    }
    
    // stuur post request naar handler.php
    xhr.open("POST", "./handler.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("moeilijkheidsgraad=easy");
}

function normal(event) {
    console.log("normal");
    
    // maak object aan
    const xhr = new XMLHttpRequest();
    
    xhr.onload = function() {
        console.log(this.responseText);
        if (this.responseText == "reload") {
            location.reload(true);
        }
    }
    
    // stuur post request naar handler.php
    xhr.open("POST", "./handler.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("moeilijkheidsgraad=normal");
}

function hard(event) {
    console.log("hard");
    
    // maak object aan
    const xhr = new XMLHttpRequest();
    
    xhr.onload = function() {
        console.log(this.responseText);
        if (this.responseText == "reload") {
            location.reload(true);
        }
    }
    
    // stuur post request naar handler.php
    xhr.open("POST", "./handler.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("moeilijkheidsgraad=hard");
}




// ingevoerde waardes doorgeven met AJAX
function waardeIngevuld(event) {
    console.log(event);
    
    // maak object aan
    const xhr = new XMLHttpRequest();

    // omdat dit asynchonous javascript is moet dit pas uitgevoederd worden als de data ontvangen is van het andere bestand
    xhr.onload = function() {
        console.log("bord geupdate");
        const spelbord = document.getElementById("spelbord");
        spelbord.innerHTML = this.responseText;
        document.querySelectorAll(".binnenkant").forEach(function (element) {
            element.addEventListener('change', waardeIngevuld);
        });
    };
    
    // stuur post request naar handler.php
    xhr.open("POST", "./handler.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("locatie=" + this.querySelector("select").name + "&value=" + this.querySelector("select").value);
}


// dit wordt sowieso 1 keer uitgevoerd als deze pagina ingeladen wordt
const xhr = new XMLHttpRequest();

xhr.onload = function() {
    console.log("bord ingeladen");
    const spelbord = document.getElementById("spelbord");
    spelbord.innerHTML = this.responseText;
    
    // nu het bord geladen is de eventlisteners toevoegen
    document.querySelectorAll(".binnenkant").forEach(function (element) {
        element.addEventListener('change', waardeIngevuld);
    });
};

xhr.open("POST", "./handler.php");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send("dataLaden=ja");

document.querySelector(".reset").classList.add("reset-animate");
document.querySelector(".reset").addEventListener('click', function() {
    const xhr = new XMLHttpRequest();
    
    xhr.onload = function() {
        window.location.href = './';
    };
    
    xhr.open("POST", "./handler.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("reset=ja");
});