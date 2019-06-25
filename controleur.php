<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$qs = "";

	if ($action = valider("action"))
	{
		ob_start ();

		echo "Action = '$action' <br />";

		// ATTENTION : le codage des caractères peut poser PB 
		// si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		//TODO: exercice 4
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");


		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{

		    case 'pageLogin' :
		    //si l'utilisateur n'est pas connecté mais qu'il se trouve sur une page où il faut l'être, on le renvoie sur la page de connexion
		        $addArgs = "?view=connexion";
		    break;

		    case 'jouer' :
		    //redirige vers la page jouer
		        $addArgs = "?view=jouer";
		    break;

		    case 'classement' :
		    //redirige vers la page classement
		        $addArgs = "?view=classement";
		    break;

		    case 'profil' :
            //redirige vers la page profil
            	$addArgs = "?view=profil";
            break;

            case 'commandes' :
            //redirige vers la page commandes
                 $addArgs = "?view=commandes";
            break;
		}

	}

	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments

	header("Location:" . $urlBase . $addArgs);
	//qs doit contenir le symbole '?'

	// On écrit seulement après cette entête
	ob_end_flush();
	
?>










