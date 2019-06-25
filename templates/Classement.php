<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");
include_once("libs/LibJules.php");

?>

<div id="classementGeneral" class="profil">
    <h1 class="profilTitre">Classement Général</h1>
    <?php
        affichageClassementGene();
    ?>
</div>

<div id="classementBtn" class="profil">
    <br/>
    <br/>
    <?php
        mkForm("controleur.php");
        mkInput("submit","action","jouer");
        endForm();
    ?>
    <br/>
    <br/>
    <?php
        mkForm("controleur.php");
        mkInput("submit","action","profil");
        endForm();
    ?>
     <br/>
     <br/>
     <?php
        mkForm("controleur.php");
        mkInput("submit","action","commandes");
        endForm();
     ?>

</div>

<div id="classementPacman" class="profil">
    <h1 class="profilTitre">Classement Pacman</h1>
     <?php
        affichageClassement("Pacman");
     ?>
</div>

<div id="classementFantomes" class="profil">
    <h1 class="profilTitre">Classement Fantômes</h1>
    <?php
        affichageClassement("Fantome");
    ?>
</div>

