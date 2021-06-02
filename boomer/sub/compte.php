<META HTTP-EQUIV="Refresh" CONTENT="120"; URL="index.php?page=compte"/>
<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=OkBoomer', 'root', '');}
	catch (Exception $e) {
		die("L'accès à la base de donnée est impossible.");}
		$requeteTrouverAmis = 'SELECT * from relationMembre WHERE (accordMembreReceveur = true AND accordMembreEnvoyeur = true) AND (idMembreReceveur = '.$_SESSION["id"].' OR idMembreEnvoyeur = '.$_SESSION["id"].');';
		$resultat = $bdd->query($requeteTrouverAmis);
		$nbrLignes = $resultat->rowCount();
		$ligne = $resultat->fetch(PDO::FETCH_OBJ);
		if(isset($_SESSION["tableauIdAmis"])){
			unset($_SESSION["tableauIdAmis"]);
		}
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
		$requeteTrouverDemande = 'SELECT * FROM relationMembre WHERE idMembreReceveur = '.$_SESSION["id"].' AND accordMembreReceveur = false;';
		$resultat = $bdd->query($requeteTrouverDemande);
		$nbrLignes = $resultat->rowCount();
		$ligne = $resultat->fetch(PDO::FETCH_OBJ);
		if(isset($_SESSION["tableauIdDemande"])){
			unset($_SESSION["tableauIdDemande"]);
		}
		$_SESSION['tableauIdDemande'] = array();
		if(!$ligne == false && ($ligne->accordMembreEnvoyeur == true && $ligne->accordMembreReceveur == false)){
			for($i = 0; $i < $nbrLignes; $i++){
				$_SESSION['tableauIdDemande'][] = $ligne->idMembreEnvoyeur;
				$ligne = $resultat->fetch(PDO::FETCH_OBJ);
			}	
		}
		$resultat->closeCursor();

?>

<script>
	function onMouseOutImage(){
		document.getElementById("imgDrawing").style.opacity = "0";
		document.getElementById("idImage").style.filter = "blur(0px)";
		document.getElementById("conteneurImageCompte").style.border = "none";
		var conteneur = document.getElementById("conteneurImageCompte");
		document.getElementById("conteneurImageCompte").style.left = conteneur.offsetLeft + 3;
		document.getElementById("conteneurImageCompte").style.top = conteneur.offsetTop + 3;
	}

	function onMouseOverImage(){
		document.getElementById("imgDrawing").style.opacity = "1";
		document.getElementById("idImage").style.filter = "blur(2px)";
		document.getElementById("conteneurImageCompte").style.border = "solid rgb(96, 130, 194)";
		var conteneur = document.getElementById("conteneurImageCompte");
		document.getElementById("conteneurImageCompte").style.left = conteneur.offsetLeft - 3;
		document.getElementById("conteneurImageCompte").style.top = conteneur.offsetTop - 3;
	}
</script>

<form id="formChangement" enctype="multipart/form-data" action="index.php?page=compte" method="post">
	<input onchange="document.getElementById('refresh').click()" files type="file" name="imageUtilisateur" id="imageUtilisateur"></br>
	<input id="refresh" type="submit" value="Changer d'image !" name="submitImg"/>
</form>

<div id="conteneurAmis">
	<table id="menuAmis">
		<thead>
			<tr>
				<th colspan="3"> Amis </th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($_SESSION["tableauIdDemande"] as $id){
					$requeteInfo = 'SELECT pseudonyme FROM Membre WHERE idMembre = '.$id.';';
					$resultat = $bdd->query($requeteInfo);
					$row = $resultat->fetch(PDO::FETCH_OBJ);
					echo "
					<tr>
						<td style='color: orange;'>
							{$row->pseudonyme}
						</td>
						<td>
							<form class='formulaireRedirectionAmi'action='index.php?page=requeteami' method='post'>
								<input class='inputRedirectionAmi' type='name' name='amiId' value='{$id}'/>
								<input style='cursor: pointer' type='submit' name='submit' value='Ajouter'/>
							</form>
						</td>
						<td>
							<form class='formulaireRedirectionAmi'action='index.php?page=tentativeAmi' method='post'>
								<input class='inputRedirectionAmi' type='name' name='friendsid' value='{$id}'/>
								<input style='cursor: pointer' type='submit' name='deleteFriend' value='Ignorer'/>
							</form>
						</td>
					</tr>";
					$resultat->closeCursor();
				} 
				foreach($_SESSION["tableauIdAmis"] as $id){
					$requeteInfo = 'SELECT pseudonyme FROM Membre WHERE idMembre = '.$id.';';
					$resultat = $bdd->query($requeteInfo);
					$row = $resultat->fetch(PDO::FETCH_OBJ);
					echo "<tr><td style='color: green;'>{$row->pseudonyme}</td><td><form class='formulaireRedirectionAmi'action='index.php?page=tentativeAmi' method='post'><input class='inputRedirectionAmi' type='name' name='friendsname' value='{$row->pseudonyme}'/><input class='inputRedirectionAmi' type='name' name='friendsid' value='{$id}'/><input style='cursor: pointer' type='submit' name='submit' value='Voir la page'/></td><td><input style='cursor: pointer' type='submit' name='deleteFriend' value='Supprimer'/></form></td></tr>";
					$resultat->closeCursor();
				}
			?>
		</tbody>
	</table>
</div>

<div class="conteneurPrincipalCompte">
	<div class="conteneurSecondaireCompte">
		<div class="imageETpinceau" onmouseout="onMouseOutImage()" onmouseover="onMouseOverImage()" onclick="document.getElementById('imageUtilisateur').click()">
			<div id="conteneurImageCompte" class="imageCompte">
				<img id='idImage' class="imageCentre" src=" 	
				<?php
				
				//ici on verifie si il y a une photo dans le dossier image de l'utilisateur, si non on affiche une image par défaut.
				$directory = "src/userpng/".$_SESSION["id"]; 
				if(!file_exists($directory)){
					mkdir($directory);
				}
				$arrayDirectory = scandir($directory);
				if($arrayDirectory == false){
					echo "src/userpng/defaultcompte.png";
				} 
				else{
					$compte = count($arrayDirectory);
							if(count($arrayDirectory) == 3){ // il faut mettre 3 car de base dans un dossier sans fichier apparent il y a deux fichiers cachés (. et ..).
								echo $directory."/image.png";
							}
							else{
								echo "src/userpng/defaultcompte.png";
							}
						}
						?>
						" alt="src/defaultcompte.png"/>
			</div>
			<img id="imgDrawing" src="src/profile-edit-link.webp"/>
		</div>
		<div id="contentInfo">
			<p style="position: relative; background-color: yellow; top: 0%"><?php echo $_SESSION["pseudo"] ?></p>
			<p> <?php echo "Prénom: {$_SESSION["prenom"]}"; ?> </p>
			<p> <?php echo "Nom: {$_SESSION["nom"]}"; ?> </p>
			<p> <?php echo "Date de naissance: {$_SESSION["annivjour"]}/{$_SESSION["annivmois"]}/{$_SESSION["annivannee"]}"; ?> </p>
			<p> <?php echo "Mail: {$_SESSION["mail"]}"; ?> </p>
		<div>
	</div>
</div>

<?php
if(isset($_POST["submitImg"])){
	$directory = "src/userpng/".$_SESSION["id"]."/";
	$file = $directory . basename($_FILES["imageUtilisateur"]["name"]);
	$imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	$canUpload = 1;
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
		$uploadOk = 0;
	}
	if($canUpload == 0){
	}
	else{
		if (move_uploaded_file($_FILES["imageUtilisateur"]["tmp_name"], $file)) {
			$renameDirect = $directory . $_FILES["imageUtilisateur"]["name"];
			rename($renameDirect, $directory."image.png");
		}
	}
}
?>