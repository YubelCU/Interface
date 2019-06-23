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

    echo "<form method=\"get\" action=\"index.php?view=jouer\">";
    echo '<button class="boutton" type=\"submit\">Jouer</button>';
    echo '</form></br>';

    echo "<form method=\"get\" action=\"index.php?view=profil\">";
    echo '<button class="boutton" type=\"submit\">Profil</button>';
    echo '</form></br>';

}

else{

    // on ajoute un bouton connexion / s'inscrire

    echo "<form method=\"get\" action=\"index.php?view=connexion\">";
    echo '<button class="boutton" type=\"submit\">Connexion</button>';
    echo '</form></br>';

    echo "<form method=\"get\" action=\"index.php?view=inscription\">";
    echo '<button class="boutton" type=\"submit\">Inscription</button>';
    echo '</form></br>';


}



// on affiche les boutons classement et commandes


    echo "<form method=\"get\" action=\"index.php?view=classement\">";
    echo '<button class="boutton" type=\"submit\">Classement</button>';
    echo '</form></br>';

    echo "<form method=\"get\" action=\"index.php?view=commandes\">";
    echo"<button class='boutton' type=\"submit\">Commandes</button>";
    echo "</form></br>";



echo "</div>";

include("footer.php");
?>

