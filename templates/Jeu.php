<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
    if (basename($_SERVER["PHP_SELF"]) != "index.php")
    {
        header("Location:../index.php?view=jeu");
        die("");
    }

    // On envoie l'entête Content-type correcte avec le bon charset
    header('Content-Type: text/html;charset=utf-8');

    // Pose qq soucis avec certains serveurs...
    echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function choixPerso(element){
        if (element.id == "pacMan") {
            console.log("pacman selectione");
            $_SESSION["perso"]="pacman";
            $("#selection").html("<h1>Vous avez sélectionné Pacman !<h1>");
            $("#selection").append("<p>La partie va commencé dans quelques instants...<p>");
            setTimeout(function(){
                document.location.href="PACMAN/jeu_pacman.html";
            }, 2000);
            
        }
        else {
            console.log("fantome selectione");
            $_SESSION["perso"]="fantome";
            $("#selection").html("<h1>Vous avez sélectionné Fantôme !<h1>");
            $("#selection").append("<p>La partie va commencé dans quelques instants...<p>");
            setTimeout(function(){
                document.location.href="PACMAN/jeu_pacman.html";
            }, 2000);
        }
    }
</script>


<div id="selection">
    Sélectionnez votre personnage :
    <input type="button" id="pacMan" value="PacMan" onclick="choixPerso(this)"/>
    <input type="button" id="ghost" value="Fantôme" onclick="choixPerso(this)"/>
</div>