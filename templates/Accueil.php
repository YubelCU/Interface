<?php

//C'est la propriété php_self qui nous l'indique :
// Quand on vient de index :
// [PHP_SELF] => /chatISIG/index.php
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:index.php?view=accueil");
    die("");
}

// On gardera dans tous les cas le classement et commandes


echo"<div class=listeBouttons>";

if (valider("connecte","SESSION")){

    // on ajoute un bouton jouer & profil

    echo "<a class='boutton' href=\"index.php?view=jouer\">Jouer</a>";
    echo "</br></br>";

    echo "<a class='boutton' href=\"index.php?view=profil\">Profil</a>";
    echo "</br></br>";


}

else{

    // on ajoute un bouton connexion / s'inscrire

    echo "<a class='boutton' href=\"index.php?view=connexion\">Connexion</a>";
    echo "</br></br>";

    echo "<a class='boutton' href=\"index.php?view=inscription\">Inscription</a>";
    echo "</br></br>";


}



// on affiche les boutons classement et commandes


    echo "<a class='boutton' href=\"index.php?view=classement\">Classement</a>";
    echo "</br></br>";

    echo "<a class='boutton' href=\"index.php?view=commandes\">Commandes</a>";
    echo "</br></br>";


echo "</div>";

include("footer.php");
?>

