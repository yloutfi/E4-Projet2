<script>
	function aucunResultat(){
		alert("Ce compte n'existe pas.")
	}
</script>

<div id="barre-navigation" class="barre-navigation">
	<a href="index.php?page=<?php if($_SESSION["compteConnecte"]){echo "deconnexion";} else{echo "connexion";} ?>">
        <div class="bouton-navigation">
            <div class="subbouton-navigation"><?php if($_SESSION["compteConnecte"]){echo "Deconnexion";} else{echo "Connexion";} ?></div>
        </div>
    </a>

    <a href="index.php?page=
	<?php 
		if($_SESSION["compteConnecte"] == true) { 
			echo "compte"; 
		} 
		else { 
			echo "inscription"; 
		} 
	?>
		">
        <div class="bouton-navigation">
            <div class="subbouton-navigation">
				<?php 
					if($_SESSION["compteConnecte"] == true){
						echo $_SESSION["pseudo"];
					}			
					else{
						echo "Inscription";
					}
				?>
			</div>
        </div>
    </a>
	
    <a href="index.php?page=offres">
        <div class="bouton-navigation">
            <div class="subbouton-navigation">Offres</div>
        </div>
    </a>

    <?php  if($_SESSION["compteConnecte"]){  ?>
	<a href="index.php?page=activites">
		<div class="bouton-navigation">
			<div class="subbouton-navigation">Activites</div>
		</div>
    </a>
	<?php  }  ?>

	<a href="index.php?page=
		<?php 
			if($_SESSION["compteConnecte"] == true){
				echo "activites";
			} 
			else{
				echo "accueil";
			}
		?>
		">
		<div id="boutonLogo" class="bouton-navigation" style="float:left">
			<img id="imageLogo" src="boomer-logo.png"/>
			<script> document.getElementById("imageLogo").style.height = document.getElementById("barre-navigation").offsetHeight; </script>
		</div>
    </a>

    <?php if($_SESSION["compteConnecte"]){ ?>
	    <div onclick="afficherBarreRecherche()" id="bouton-recherche-ami" class="bouton-navigation">
	        <div class="subbouton-navigation">Trouver un ami...</div>
	    </div>
    <?php } ?>

</div>

<div class="sousbarre">
    <div class="bouton-navigation">
        <div>Offres</div>
    </div>
</div>

<div>
	<div onclick="cacherBarreRecherche()" id="overlay-recherche">
	</div>

	<div style="font-weight: bold" id="bulle-recherche">
		<p>ENTREZ LE PSEUDONYME DE L'UTILISATEUR ET APPUYEZ SUR 'ENTRER'</p>
		<form method="post" action="index.php?page=tentativeAmi">
			<input id="input-bulle-recherche" type="name" name="friendsname"/>
		</form>
	</div>
</div>

<script>
	function afficherBarreRecherche(){
		var bouton = document.getElementById("bouton-recherche-ami");
		var bulle = document.getElementById("bulle-recherche");
		var input = document.getElementById("input-bulle-recherche");
		var overlay = document.getElementById("overlay-recherche");
		input.style.pointerEvents = "auto";
		overlay.style.opacity = "0.92";
		bulle.style.opacity = "1";
		overlay.style.pointerEvents = "auto";
		input.focus();
	}

	function cacherBarreRecherche(){
		var bouton = document.getElementById("bouton-recherche-ami");
		var bulle = document.getElementById("bulle-recherche");
		var overlay = document.getElementById("overlay-recherche");
		var input = document.getElementById("input-bulle-recherche");
		bulle.style.opacity = "0";
		overlay.style.opacity = "0";
		overlay.style.pointerEvents = "none";
		input.style.pointerEvents = "none";
		document.getElementById("input-bulle-recherche").blur();
	}
</script>