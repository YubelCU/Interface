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
    echo $date." ".$role." ".$victoire." ".$score;
    echo "</div>";

}


/*La fonction renvoie le score de l'utilisateur et le role (Pacman ou Fantome) de la partie sous forme d'un tableau [score, role]*/

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


//Renvoie le meilleur score et le rôle joué lors de la partie
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
    echo $highscore." (".$role." )";



}



?>