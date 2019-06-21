<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

?>

<h1 class="CommandesTitre" >Commandes Pacman</h1>

<div class="Commandes">

    <p>Utilise les flèches pour te déplacer</p>

</div>

<h1 class<h1 class="CommandesTitre" >Commandes Fantômes</h1>


<div class="Commandes">

    <p>Utilise les flèches pour te déplacer et manger les Pacman</p>

</div>

<form id="formCommandes" action="controleur.php" method="GET">

   <input type="submit" name="action" value="Jouer"/>

</form>

