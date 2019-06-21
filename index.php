<?php
session_start();

/*
  Cette page génère les différentes vues de l'application en utilisant des templates situés dans le répertoire "templates". Un template ou 'gabarit' est un fichier php qui génère une partie de la structure XHTML d'une page.

  La vue à afficher dans la page index est définie par le paramètre "view" qui doit être placé dans la chaîne de requête. En fonction de la valeur de ce paramètre, on doit vérifier que l'on a suffisamment de données pour inclure le template nécessaire, puis on appelle le template à l'aide de la fonction include

  Les formulaires de toutes les vues générées enverront leurs données vers la page data.php pour traitement. La page data.php redirigera alors vers la page index pour réafficher la vue pertinente, généralement la vue dans laquelle se trouvait le formulaire.
  */


    include_once "libs/maLibUtils.php";

    // on récupère le paramètre view éventuel
    	$view = valider("view");

    // S'il est vide, on charge la vue accueil par défaut
    if (!$view) $view = "accueil";


    switch($view)
    	{

    		case "accueil" :
    		    include("templates/header.php");
    			include("templates/Accueil.php");
    		break;

    		case "connexion" :
    		    include("templates/header.php");
    		    include("templates/Connexion.php");
    		break;

    		case "profil" :
    		    include("templates/header.php");
    		    include("templates/Profil.php");
    		break;

    		case "classement" :
    		    include("templates/header.php");
    		    include("templates/Classement.php");
    		break;

    		case "commandes" :
                include("templates/header.php");
                include("templates/Commandes.php");
            break;

    		default : // si le template correspondant à l'argument existe, on l'affiche
            			if (file_exists("templates/$view.php"))
            				include("templates/$view.php");
        }

?>