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
 echo " <script src='js/script.js'></script>";


 //$idUtilisateur = "0"; modifier paramètre par l'id de l'utilisateur connecté


//Si l'utilisateur n'est pas connecté mais arrive à cette page, on lui propose d'aller se connecter
if (valider("connecte","SESSION") == false)
{
    echo "<div id='profilConnexion'>";
    echo "<h1> Connecte toi pour avoir accès à ton profil </h1>";

    mkForm("controleur.php");
    mkInput("submit","action","pageLogin");
    endForm();
    echo "</div>";
}


//Si l'utlisateur est connecté, on affiche les données qui le concernent
if (valider("connecte","SESSION"))
{
    $idUtilisateur = $_SESSION["id"];
    echo "
        <div id='profilPersonnage' class='profil'>
            <h1 class='profilTitre'>Ton personnage</h1>

    ";
    $couleur = apparence($idUtilisateur);
    currentColor($couleur);
    echo "
            <img id='vuBleu' class='vu' src='ressources/bleu.png' alt='bleu' onclick='changerCouleur();'/>
            <img id='vuRouge' class='vu' src='ressources/rouge.png' alt='rouge'/>
            <img id='vuJaune' class='vu' src='ressources/jaune.png' alt='jaune'/>
            <br/>
            <img id='vuVert' class='vu' src='ressources/vert.png' alt='vert'/>
            <img id='vuGris' class='vu' src='ressources/gris.png' alt='gris'/>
            <img id='vuRose' class='vu' src='ressources/rose.png' alt='rose'/>


        </div>

        <div id='profilBtn' class='profil'>

    ";
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    mkForm("controleur.php");
    mkInput("submit","action","jouer");
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    mkInput("submit","action","classement");
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    mkInput("submit","action","commandes");
    endForm();
    echo "
       </div>

           <br/>

           <div id='profilHistorique' class='profil'>
               <h1 class='profilTitre'>Historique</h1>

    ";

    $historique = listerParties($idUtilisateur);
    afficherHistorique($historique,$idUtilisateur);  //modifier paramètre par l'id de l'utilisateur connecté
    echo "
           </div>

           <div id='profilStats' class='profil'>
               <h1 class='profilTitre'>Tes statistiques</h1>
    ";
    echo "Nombres de parties jouées : ";
    echo NbParties($idUtilisateur);
    echo "<br/>";
    echo "Parties jouées en tant que Pacman : ";
    echo NbPartiesPacman($idUtilisateur);
    echo "<br/>";
    echo "Parties jouées en tant que Fantôme : ";
    echo NbPartiesFantomes($idUtilisateur);
    echo "<br/>";
    echo "Victoires : ";
    echo victoires($idUtilisateur);
    echo "<br/>";
    echo "Meilleur score : ";
    $tab = listerParties($idUtilisateur);
    HighScore($tab,$idUtilisateur);
    echo "

           </div>
     ";
}
?>

