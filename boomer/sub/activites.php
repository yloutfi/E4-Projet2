<?php
	if(!$_SESSION["compteConnecte"]){
		header("Refresh:0; url=index.php?page=accueil");
	}
?>
<div class="backgroundActivites">
	<div class="activite1">
		<div style="text-align: center"><br></br><h2><a href="index.php?page=salon">Sport</a></h2><br></br></div>
	</div>
	<div class="activite2">
		<div style="text-align: center"><br></br><h2>Musique</h2><br></br></div>
	</div>
	<div class="activite3">
		<div style="text-align: center"><br></br><h2>Théâtre</h2><br></br></div>
	</div>
	<div class="activite4">
		<div style="text-align: center"><br></br><h2>Informatique</h2><br></br></div>
	</div>
	<div class="activite5">
		<div style="text-align: center"><br></br><h2>Jeux</h2><br></br></div>
	</div>
</div>