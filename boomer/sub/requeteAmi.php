<script>
	function RequeteEnvoye(){
		alert("Requête d'ami envoyée!");
	}

	function RequeteAccepte(){
		alert("Vous et <?php echo $_SESSION["friendPseudo"]; ?> êtes maintenant amis !");
	}
</script>


<p><?php echo $_POST["amiId"]; ?></p>
<?php
	$idAmi = $_POST["amiId"];
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=OkBoomer', 'root', '');}
	catch (Exception $e) {
	die("L'accès à la base de donnée est impossible.");}
	$requeteVerification = 'SELECT * FROM relationMembre WHERE idMembreEnvoyeur = "'.$idAmi.'" AND idMembreReceveur = "'.$_SESSION["id"].'";';
	$resultat = $bdd->query($requeteVerification);
	$ligne = $resultat->fetch(PDO::FETCH_OBJ);
	if(!$ligne){
		$requeteEnvoiAmitie = 'INSERT INTO relationMembre(idMembreEnvoyeur, idMembreReceveur, accordMembreEnvoyeur, accordMembreReceveur) values('.$_SESSION["id"].', '.$idAmi.', true, false);';
		$bdd->exec($requeteEnvoiAmitie);
		echo "insertion";
		echo "<script>RequeteEnvoye();</script>";
	}
	else{
		$requeteModificationRelation = 'UPDATE relationMembre SET accordMembreReceveur=true WHERE idMembreEnvoyeur = "'.$idAmi.'" AND idMembreReceveur = "'.$_SESSION["id"].'";';
		$bdd->exec($requeteModificationRelation);
		$_SESSION["tableauIdAmis"][] = $idAmi;
		echo "modification";
		echo "<script>RequeteAccepte();</script>";
	}
	$resultat->closeCursor();
	header("Refresh:0; url=index.php?page=ami");
?>