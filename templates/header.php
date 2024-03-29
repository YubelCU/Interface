<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../interface/index.php");
    die("");
}

// On envoie l'entête Content-type correcte avec le bon charset
header('Content-Type: text/html;charset=utf-8');

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
    <title>PacMan</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>

<div id="banniere">
    <img id="logo" src="ressources/pacman.jpg">
    <a id="nomJeu" href ="index.php?view=accueil" >PACMAN</a>
    <div id="blockLiens">

<?php
if (valider("connecte","SESSION")) {


    if ($pseudo = valider("pseudo", "SESSION")) {
        echo '<a class="lien" href="index.php?view=jouer">Jouer</a>';
        echo '<a class="lien" href="index.php?view=profil">Profil</a>';
    };
}
else{
    echo '<a class="lien" href="index.php?view=connexion">Connexion</a>';
    echo '<a class="lien" href="index.php?view=inscription">Inscription</a>';
}

?>
        <a class="lien" href = "index.php?view=classement" > Classement</a>
        <a class='lien' href = "index.php?view=commandes" > Commandes</a>

    </div>

<?php
// Si l'utilisateur est connecté, on affiche le pseudo et un input déconnexion
if (valider("connecte","SESSION")) {

    // on veut récupérer le pseudo de l'utilisateur

    // si l'utilisateur est connecté, pas besoin de if car on sait qu'il a un pseudo

    if ($pseudo = valider("pseudo", "SESSION")) {
        echo "<form method=\"get\" action=\"./controleur.php\">";
        echo "<button id='deconnexion' name ='action' value='Deconnexion' type=\"submit\">Deconnexion</button>";
        echo "<div id='nomUtilisateur'>$pseudo</div>";
        echo "</form>";
    };
}

else {

    echo "<a href='index.php?view=connexion' id=\"message\">Vous n'êtes pas connecté...</a>";
    echo "<img id=\"decu\" src=\"ressources/deçu.png\">";

}


?>


</div>

