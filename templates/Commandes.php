<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

?>

<div class="Commandes" id="commandesPacman">
    <h1 class="profilTitre" >Commandes Pacman</h1>

    <p>Utilise les flèches pour te déplacer</p>
    <p>...</p>

</div>




<div class="Commandes" id="commandesFantome">
    <h1 class="profilTitre" >Commandes Fantômes</h1>

    <p>Utilise les flèches pour te déplacer et manger les Pacman</p>
    <p>...</p>

</div>

<form class="Commandes" id="formCommandes" action="controleur.php" method="GET">
    <br/>
    <br/>
   <input type="submit" name="action" value="Jouer"/>


</form>

