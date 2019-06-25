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

		echo "Action = '$action' <br/>";

		// ligne du dessus à enelever ?

		if ($action != "Connexion") 
			securiser("login");


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

            case 'Connexion' :
                // On verifie la presence des champs login et passe
                $qs = "?view=connexion";

                if ($login = valider("login"))
                if ($passe = valider("passe"))
                {
                    // On verifie l'utilisateur, et on crée des variables de session si tout est OK
                    // Cf. maLibSecurisation
                    if (verifUser($login,$passe))
                        $qs = "?view=accueil";
                }
            break;


            case 'Deconnexion' :
                session_destroy();
                $qs = "?view=connexion";
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










