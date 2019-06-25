<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=connexion");
    die("");
}

?>


<div class="listeBouttons">
    <form action="./controleur.php" method="GET">
        Nom d'utilisateur
        </br>

        <input class="textInp" type="text" name="login" />
        </br>
        Mot de passe
        </br>
        <input class="textInp" type="password" name="passe" />
        </br>
        </br>
            <input class="boutton" type="submit" name="action" value="Connexion" />
    </form>

    <a id="bouttonInscription" href="index.php?view=inscription">Pas encore inscrit ?</a>
</div>


