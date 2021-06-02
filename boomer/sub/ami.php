<div class="conteneurPrincipalCompte">
	<div class="conteneurSecondaireCompte">
		<div onclick="document.getElementById('<?php $estAmi = false; foreach($_SESSION["tableauIdAmis"] as $id){if($id == $_SESSION["friendId"]){ $estAmi = true; }} if($estAmi == false){echo 'requeteami'; }?>').click();" class="imageETpinceau">
			<div style="cursor: pointer" id="conteneurImageCompte" class="imageCompte">
				<img id='idImage' class="imageCentre" src=" 	
				<?php
				
				//ici on verifie si il y a une photo dans le dossier image de l'utilisateur, si non on affiche une image par défaut.
				$directory = "src/userpng/".$_SESSION["friendId"]; 
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
		</div>
		<div id="contentInfo">
			<p style="position: relative; background-color: yellow; top: 0%"><?php echo $_SESSION['friendPseudo'] ?></p>
			<p> <?php echo "Prénom: {$_SESSION["friendPrenom"]}"; ?> </p>
			<p> <?php echo "Nom: {$_SESSION["friendNom"]}"; ?> </p>
			<p> <?php echo "Date de naissance: {$_SESSION["friendJour"]}/{$_SESSION["friendMois"]}/{$_SESSION["friendAnnee"]}"; ?> </p>
			<p> <?php echo "Mail: {$_SESSION["friendMail"]}"; ?> </p>
		</div>
	</div>
</div>

<form action="index.php?page=requeteami" method="post">
	<input id="requeteami" name="amiId" type="submit" value="<?php echo $_SESSION["friendId"]; ?>"/>
</form>