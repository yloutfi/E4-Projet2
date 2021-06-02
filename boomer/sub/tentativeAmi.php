<?php
	try {
	$bdd = new PDO('mysql:host=localhost;dbname=OkBoomer', 'root', '');}
	catch (Exception $e) {
		die("L'accès à la base de donnée est impossible.");}
	if(isset($_POST["deleteFriend"])){
		$requeteSupprimerRelation = 'DELETE FROM relationMembre WHERE idMembreEnvoyeur = "'.$_POST["friendsid"].'" AND idMembreReceveur = "'.$_SESSION["id"].'" OR idMembreEnvoyeur = "'.$_SESSION["id"].'" AND idMembreReceveur = "'.$_POST["friendsid"].'";';
		$resultatSupprimer = $bdd->exec($requeteSupprimerRelation);
		foreach($_SESSION["tableauIdAmis"] as $i => $id){
			if($id == $_POST["friendsid"]){
				unset($_SESSION["tableauIdAmis"][$i]);
			}
		}
		header("Refresh:0; url=index.php?page=compte");
	}
	else{
		if(isset($_POST["friendsname"])){
			$pseudoAmi = $_POST["friendsname"];
			$resultat = $bdd->query("SELECT * from Membre where pseudonyme ='".$pseudoAmi."';");
			$ligne = $resultat->fetch(PDO::FETCH_OBJ);
			if(!$ligne){
				echo "<script>aucunResultat();</script>";
				$resultat->closeCursor();
				header("Refresh:0; url=index.php?page=activites");
			}
			else{
				$_SESSION["friendPseudo"]     = $ligne->pseudonyme;
				$_SESSION["friendPrenom"]     = $ligne->prenom;
				$_SESSION["friendNom"]        = $ligne->nom;
				$_SESSION["friendJour"]       = $ligne->jourNaissance;
				$_SESSION["friendMois"]       = $ligne->moisNaissance;
				$_SESSION["friendAnnee"]      = $ligne->anneeNaissance;
				$_SESSION["friendMail"]       = $ligne->email;
				$_SESSION["friendFound"]      = 1;
				$_SESSION["friendId"]         = $ligne->idMembre;
				$resultat->closeCursor();
				header("Refresh:0; url=index.php?page=ami");
			}
		}
	}
?>