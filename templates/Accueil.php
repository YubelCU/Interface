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
    header("Location:../index.php?view=accueil");
    die("");
}

// on distingue le cas connecté du cas non connecté

// On gardera dans tous les cas le classement et commandes

if (valider("connecte","SESSION")){

    // on ajoute un bouton jouer & profil

    echo

}

else{

    // on ajoute un bouton connexion / s'inscrire

}
?>
