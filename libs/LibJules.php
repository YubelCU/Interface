<?php

/*Historique pour la page profil*/

function afficherHistorique($tab,$numId)
{
    //Attention le tableau peut être vide
    if (count($tab) == 0) return;

    //pour chaque parties
    foreach($tab as $value)
    {
        $scoreUtilisateur = score($value,$numId);
        $resultat = resultat($value,$numId);

        affichageLigne($value["date"], $scoreUtilisateur[1], $resultat, $scoreUtilisateur[0]);

    }

}

function affichageLigne($date, $role, $victoire, $score)
{

    echo "<div class='historique'>";
    echo $date." &nbsp".$role." &nbsp".$victoire." &nbsp".$score." pts";
    echo "</div>";


}


/*La fonction renvoie le score de l'utilisateur, le role (Pacman ou Fantome) et l'id de la partie sous forme d'un tableau [score, role,id]*/

function score($val,$numId){

    //on cherche l'indice de la liste correspondant à l'utilisateur pour les parties Pacman
            $indice = -1;
            $nbPacman = 0;
            $role ="";

            //on casse la chaine de caractère en un tableau
            $idPacman = explode(",",$val["idPacman"]);
            foreach($idPacman as $cle => $val2)
            {
                if($val2 == $numId)
                {
                    $indice = $cle;
                    //une fois qu'on a l'indice, on va pouvoir récupérer le score
                    $score = explode(",",$val["score"]);
                    //puis le score de l'utilisateur grace à l'indice déterminé ci-dessus
                    $scoreUtilisateur = $score[$indice];
                    $role = "Pacman";



                }
                //on compte le nombre de Pacman
                $nbPacman = $nbPacman + 1;
            }

            //si l'indice vaut -1, c'est que le joueur est un fantôme
            if($indice == -1)
            {

                //on doit chercher l'indice du jouer dans la liste des fantômes
                $idGhost = explode(",",$val["idGhost"]);
                foreach($idGhost as $cle => $val3)
                {

                    if($val3 == $numId)
                    {

                        $indice = $cle + $nbPacman; //les scores des fantômes viennent après ceux des pacman
                        $score = explode(",",$val["score"]);
                        $scoreUtilisateur = $score[$indice];
                        $role = "Fantôme";


                    }

                }

            }
    return array($scoreUtilisateur,$role);

}

function resultat($tab,$numId)
{
    if($tab["victoire"] == $numId)
    {
        return "Victoire";
    }
    else
    {
        return "Défaite";
    }
}


/*Statistiques pour la page profil*/


//Renvoie le meilleur score et le rôle joué lors de la partie pour un joueur
function HighScore($tab,$numId)
{
    $highscore = 0;
    $role = "";
    //on parcourt les scores des parties pour trouver le meilleur
    foreach($tab as $value)
    {

        $tableauxScores = score($value,$numId);
        if ($tableauxScores[0] > $highscore){

            $highscore = $tableauxScores[0];
            $role = $tableauxScores[1];
        }

    }
    echo $highscore." ( ".$role." )";

}



/*Apparence pour la page profil*/

//affiche la couleur choisie par l'utilisateur
function currentColor($couleur)
{
    echo "<img id='currentColor' src='ressources/".$couleur.".png' alt='".$couleur."'/>";
}



/*Page Classement */


//renvoie un tableau de tableau avec toutes les parties ordonnées
function classementGene(){

    //On va chercher un tableau contenant toutes les parties
    $listeParties = listerPartiesGlobal();
    $listePartiesOrdo = extractionDonnees($listeParties);
    usort($listePartiesOrdo, "tri");

    return $listePartiesOrdo;


}


//La fonction renvoie un tableau de tableau contenant le score, le joueur,
//le role et la date pour toutes les parties à partir du tableau obtenu avec la requête SQL
function extractionDonnees($tab){

    $listePartieOrdo = array();
    //pour toutes les parties
    foreach($tab as $val)
    {
        //on crée un tableau contenant les id des Pacmans
        $tableauPacman = explode(",",$val["idPacman"]);
        $tableauScore = explode(",",$val["score"]);
        $tableauPacman;
        //pour chaque pacman, on ajoute un tableau à la liste des parties
        $partie = array();
        $nbPacman = 0;

        foreach($tableauPacman as $cle => $val2)
        {
            //on ajoute le score, le joueur, le role et la date
            array_push($partie, $tableauScore[$cle] ,$tableauPacman[$cle],"Pacman", $val["date"]);
            array_push($listePartieOrdo, $partie);
            $nbPacman = $nbPacman + 1;
            $partie = array();
        }

        //on fait la même chose pour les fantômes
        $tableauFantome = explode(",",$val["idGhost"]);
        //pour chaque fantome on ajoute un tableau à la liste des parties

        foreach($tableauFantome as $cle => $val2)
        {
            //attention, le score du fantome correspond à $cle + le nombre de pacman de la partie
            array_push($partie, $tableauScore[$cle + $nbPacman], $tableauFantome[$cle],"Fantome",$val["date"]);
            array_push($listePartieOrdo, $partie);
            $partie = array();
        }

        //on ajoute ce tableau au tableau des parties

    }

    //on renvoie un tableau de tableau contenant le score, le joueur, le role et la date
    return $listePartieOrdo;
}


//Cette fonction définit le critère de tri pour la fonction usort()
function tri($a,$b)
{
    //on compare les scores des 2 tableaux
    if($a[0] >= $b[0])
    {
        return -1;
    }

    else
    {
        return 1;
    }
}


//la fonction fait correspondre les id du tableau de tableau ordonné avec
//le noms des joueurs et renvoie le tableau de tableau contenant score, id, role, date,nomdujoueur.
function match($joueur,$score)
{
    foreach($score as $cle => $val)
    {
        $idJoueur = $val[1];
        // on cherche dans la liste à quel joueur cela correspond
        foreach($joueur as $val2)
        {
            if($val2["id"] == $idJoueur)
            {
                array_push($score[$cle],$val2["pseudo"]);
            }
        }
    }
    return $score;
}

//affiche les 10 premiers du classement général
function affichageClassementGene(){

    //on récupère le tableau de tableau ordonné
    $classement = classementGene();
    //on récupère la liste des joueurs
    $listeJoueur = idJoueur();
    //on ajoute le nom des joueurs dans le tableau
    $classement = match($listeJoueur,$classement);


    echo "<div class='classementGene'>";
    echo "Rang Pseudo Points Role Date";
    echo "<br/>";
    for($i = 0; $i <= 4; $i++)
    {
        $j = $i+1;
        echo $j." ".$classement[$i][4]." ".$classement[$i][0]." ".$classement[$i][2]." ".$classement[$i][3];
        echo "<br/>";
    }
    echo "</div>";

}

//affiche les 10 premiers du classement Pacman ou Fantômes
function affichageClassement($role){

    //on récupère le tableau de tableau ordonné
    $classement = classementGene();

    //on ne récupère que les parties correspondant au role demandé
    $classement = triRole($classement,$role);

    //on récupère la liste des joueurs
    $listeJoueur = idJoueur();

    //on ajoute le nom des joueurs dans le tableau
    $classement = match($listeJoueur,$classement);


    echo "<div class='classementGene'>";
        echo "Rang Pseudo Points Role Date";
        echo "<br/>";
        for($i = 0; $i <= 4; $i++)
        {
            $j = $i+1;
            echo $j." ".$classement[$i][4]." ".$classement[$i][0]." ".$classement[$i][2]." ".$classement[$i][3];
            echo "<br/>";
        }
        echo "</div>";

}

function triRole($tab,$role){

    $classementRole = array();

    foreach($tab as $val)
    {
        if($val[2] == $role)
        {
            array_push($classementRole,$val);
        }
    }
    return $classementRole;
}

?>