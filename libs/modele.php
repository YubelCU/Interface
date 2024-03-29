<?php

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles dans la base de données
*/


include_once("libs/maLibSQL.pdo.php");

/*Historique pour la page profil*/

function listerParties($numId){
	// Cette fonction liste les parties de l'utilisateur
	// et renvoie un tableau d'enregistrements.
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,victoire,idPackman,idGhost,date

    //on recherche toutes les parties jouées par l'utilisateur concerné
	$SQL = "SELECT * FROM historique WHERE idPacman LIKE '%" .$numId."%'
	UNION SELECT * FROM historique WHERE idGhost LIKE '%".$numId."%'
	ORDER BY date DESC";

    //on renvoi un tableau contenant les données demandées
	return parcoursRs(SQLSelect($SQL));

}

/*Page connexion, ID BDD ... */

function verifUserBdd($login,$passe)
{
    // Vérifie l'identité d'un utilisateur
    // dont les identifiants sont passes en paramètre
    // renvoie faux si user inconnu
    // renvoie l'id de l'utilisateur si succès

    $SQL = "SELECT id FROM profil WHERE pseudo='$login' AND passe='$passe'";


    return SQLGetChamp($SQL);
}


/*Statistique pour la page profil*/

function NbParties($numId){

    $SQL1 = "SELECT COUNT(*) FROM historique WHERE idGhost LIKE '%".$numId."%'";
    $SQL2 = "SELECT COUNT(*) FROM historique WHERE idPacman LIKE '%".$numId."%'";

    return SQLGetChamp($SQL1) + SQLGetChamp($SQL2);

}

function NbPartiesPacman($numId){

    $SQL = "SELECT COUNT(*) FROM historique WHERE idPacman LIKE '%".$numId."%'";
    return SQLGetChamp($SQL);

}

function NbPartiesFantomes($numId){

    $SQL = "SELECT COUNT(*) FROM historique WHERE idGhost LIKE '%".$numId."%'";
    return SQLGetChamp($SQL);

}

function victoires($numId){

    $SQL = "SELECT COUNT(*) FROM historique WHERE victoire=".$numId;
    return SQLGetChamp($SQL);

}

/*Apparence pour la page profil*/

function apparence($numId){

    $SQL="SELECT apparence FROM profil WHERE id=".$numId;
    return SQLGetChamp($SQL);
}

function updateApparence($couleur,$numId)
{
    $SQL = "UPDATE profil SET apparence=".$couleur."WHERE id=".$numId;
    SQLUpdate($SQL);
}

/*Page Classement */

//La fonction renvoie toutes les parties présentent dans la base de données
function listerPartiesGlobal(){

    $SQL="SELECT * FROM historique";
    return parcoursRs(SQLSelect($SQL));
}

//Renvoie un tableau contenant la liste des joueurs avec leur id
function idJoueur()
{
    $SQL = "SELECT id,pseudo FROM profil";
    return parcoursRs(SQLSelect($SQL));
}

?>