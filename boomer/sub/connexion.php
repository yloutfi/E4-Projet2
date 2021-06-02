<div class="inscriptionCont">
	<form action="index.php?page=connexion" method="post">
		Adresse e-mail:</br><input class="informationInscription" 
		type="mail" required name="email"/></input><br>
		Mot de passe:</br><input class="informationInscription" 
		type="password" required name="mdp"/></input><br>
		<input class="submitInscription" 
		type="submit" name="valider" value="Se connecter"/><br/>
	</form>    
</div>

<?php
if(isset($_POST['valider'])){
	$email = $_POST['email'];
	$mdp = $_POST['mdp'];
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=OkBoomer', 'root', '');}
	catch (Exception $e) {
		die("L'accès à la base de donnée est impossible.");}
	$requete = 'SELECT * FROM Membre WHERE email="'.$email.'" AND mdp="'.$mdp.'";';
	$resultat = $bdd->query($requete);
	$ligne = $resultat->fetch(PDO::FETCH_OBJ);

	if(!$ligne){
		echo "Ce compte n'existe pas ou le mot de passe est faux.";
	}
	else{
		$_SESSION["pseudo"] = $ligne->pseudonyme;
		$_SESSION["prenom"] = $ligne->prenom;
		$_SESSION["nom"] = $ligne->nom;
		$_SESSION["annivjour"] = $ligne->jourNaissance;
		$_SESSION["annivmois"] = $ligne->moisNaissance;
		$_SESSION["annivannee"] = $ligne->anneeNaissance;
		$_SESSION["mail"] = $ligne->email;
		$_SESSION["mdp"] = $ligne->mdp;
		$_SESSION["id"] = $ligne->idMembre;
		$_SESSION["compteConnecte"] = true;
		$resultat->closeCursor();
		
		$requeteTrouverAmis = 'SELECT * from relationMembre WHERE (accordMembreReceveur = true AND accordMembreEnvoyeur = true) AND (idMembreReceveur = '.$_SESSION["id"].' OR idMembreEnvoyeur = '.$_SESSION["id"].');';
		$resultat = $bdd->query($requeteTrouverAmis);
		$nbrLignes = $resultat->rowCount();
		$ligne = $resultat->fetch(PDO::FETCH_OBJ);
		$_SESSION['tableauIdAmis'] = array();
		if(!$ligne == false && ($ligne->accordMembreEnvoyeur == true && $ligne->accordMembreReceveur == true)){
			for($i = 0; $i < $nbrLignes; $i++){
				if($ligne->idMembreEnvoyeur != $_SESSION["id"]){
					$_SESSION['tableauIdAmis'][] = $ligne->idMembreEnvoyeur;
				}
				else{
					$_SESSION['tableauIdAmis'][] = $ligne->idMembreReceveur;
				}
				$ligne = $resultat->fetch(PDO::FETCH_OBJ);
			}	
		}
		$resultat->closeCursor();
		header("Refresh:0; url=http://boomer/index.php?page=activites");
	}
}
?>

  