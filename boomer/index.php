<?php session_start(); ?>
<doctype html>
    <html>
        <head>
            <link rel="stylesheet" href="style.css"/>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans"/>
            <title>OK BOOMER!</title>
            <link rel="icon" type="image/png" href="boomer-logo.png"/>
        </head>
		<header>
			<?php 
				$PARAM_hote='localhost';
				$PARAM_port='3306';
				$PARAM_nom_bd='okBoomer';
				$PARAM_utilisateur='root';
				$PARAM_mot_passe='';
			?>
		</header>
        <body>
			<div id="page">
				<?php
					if(!isset($_SESSION["compteConnecte"])){
						$_SESSION["pseudo"] = null;
						$_SESSION["prenom"] = null;
						$_SESSION["nom"] = null;
						$_SESSION["annivjour"] = null;
						$_SESSION["annivmois"] = null;
						$_SESSION["annivannee"] = null;
						$_SESSION["mail"] = null;
						$_SESSION["mdp"] = null;
						$_SESSION["id"] = null;
						$_SESSION["compteConnecte"] = false;	
					}
					include("sub/entete.php");
					if (isset($_GET['page'])) {
						$page = $_GET['page'];
					}
					else  {
						if($_SESSION["compteConnecte"]){
							$page = "activites"; 
						}
						else{
							$page = "accueil"; 
						}
					}
					switch($page){
						case "accueil":
							include ("sub/accueil.php");
							break;
						case "activites":
							include("sub/activites.php");
							break;
						case "compte":
							include("sub/compte.php");
							break;
						case "inscription":
							include("sub/inscription.php");
							break;
							case "connexion":
							include("sub/connexion.php");
							break;
						case "szlon":
							include("sub/offres.php");
							break;
						case "deconnexion":
							include("sub/deconnexion.php");
							break;
						case "ami":
							include("sub/ami.php");
							break;
						case "tentativeAmi":
							include("sub/tentativeAmi.php");
							break;
						case "requeteami":
							include("sub/requeteAmi.php");
							break;
					}
				?>
			</div>
        </body>
    </html>
git config --global user.name "yloutfi"