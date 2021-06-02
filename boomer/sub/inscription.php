<div>
	<?php
	    if(!isset($_POST['ok'])){   
	    ?>
	    	<div class="inscriptionCont">
		        <form action="index.php?page=inscription" method="post">
		            Prénom:<br/><input class="informationInscription" type="text" name="prenom" required minlength="2" autocomplete="off"/><br/>
		            Nom:<br/><input class="informationInscription" type="text" name="nom" required minlength="2"/><br/>
		            Pseudonyme:<br/><input class="informationInscription" type="text" name="pseudo" required minlength="2"/><br/> 
		            Date d'anniversaire:<br/><input style="width: 45px" class="informationInscription" type="number" name="jour" required min="1" max="31"/>/<input style="width: 45px" class="informationInscription" type="number" name="mois" required min="1" max="12"/>/<input class="informationInscription" type="number" name="annee" required min="1900" max="2020"/><br/>
		            E-mail:<br/><input class="informationInscription" type="text" name="mail" required minlength="2"/><br/>
		            Mot de passe:<br/><input class="informationInscription" type="password" name="mdp" required minlength="2"/><br/>
		            <input class="submitInscription" type="submit" name="ok" value="S'inscrire"/>
		        </form>    
	    	</div>
	    <?php
	    }
	?>

	<?php
	    if(isset($_POST['ok'])){
	        $pseudo = $_POST["pseudo"];
	        $prenom = $_POST["prenom"];
	        $nom = $_POST["nom"];
	        $annivjour = $_POST["jour"];
	        $annivmois = $_POST["mois"];
	        $annivannee= $_POST["annee"];
	        $mail = $_POST["mail"];
	        $mdp = $_POST["mdp"];
	        try {
				$connexion = new PDO('mysql:host='.$PARAM_hote.';
				dbname='.$PARAM_nom_bd,
				$PARAM_utilisateur,
				$PARAM_mot_passe);
	            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        }
	        catch(Exception $e) {
	            echo 'Erreur';
	        }
	        $requeteVerifPseudo = 'SELECT pseudonyme FROM Membre WHERE pseudonyme ="'.$pseudo.'";';
	        $requeteVerifMail = 'select email from Membre where email = "'.$mail.'";';
	        $resultatPseudo=$connexion->query($requeteVerifPseudo);
	        $verifPseudo=$resultatPseudo->fetch(PDO::FETCH_OBJ);
	        $resultatMail=$connexion->query($requeteVerifMail);
			$verifMail=$resultatMail->fetch(PDO::FETCH_OBJ);
			
	        if(preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail)){
		        if(!$verifMail && !$verifPseudo){
			        $requeteInscription = 'insert into Membre(prenom, nom, pseudonyme, jourNaissance, moisNaissance, anneeNaissance, email, mdp) values("'.$prenom.'","'.$nom.'","'.$pseudo.'",'.$annivjour.','.$annivmois.','.$annivannee.',"'.$mail.'","'.$mdp.'");';
			        $connexion->exec($requeteInscription);
			        //cette requete en dessous sert à créer le dossier image de l'utilisateur à l'aide de son id
			        $requeteCo = 'SELECT * FROM Membre WHERE email="'.$mail.'";';
			        $resultatMail = $connexion->query($requeteCo);
			        $ligne = $resultatMail->fetch(PDO::FETCH_OBJ);
			        $id = $ligne->idMembre;
			       	$directory = "src/userpng/".$id;
			        mkdir($directory);
			        $id = null;?> 
		            <div>Bienvenue 
		            <?php echo $prenom ?>!
		            <br/>Vous pouvez maintenant vous connecter !<br/>
		            <a href="index.php?page=connexion"><div>Se connecter</div></a><?php
		        }
		        else{
		        	echo 'votre mail ou votre pseudo est déjà utilisé';
		        }
		    }
		    else{
		    	echo 'veuillez entrer un mail valide';
		    	header("Refresh:5; url=index.php?page=accueil");
		    }
	        $resultatMail->closeCursor();
	        $resultatPseudo->closeCursor();
	    }
	?>
</div>