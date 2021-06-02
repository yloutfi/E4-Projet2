<?php
	$_SESSION["pseudo"] = null;
	$_SESSION["prenom"] = null;
	$_SESSION["nom"] = null;
	$_SESSION["annivjour"] = null;
	$_SESSION["annivmois"] = null;
	$_SESSION["annivannee"] = null;
	$_SESSION["mail"] = null;
	$_SESSION["mdp"] = null;
	$_SESSION["compteConnecte"] = false;
	$_SESSION["tableauIdAmis"] = null;
	header("Refresh:0; url=http://boomer/index.php?page=accueil");
?>