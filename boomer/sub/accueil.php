<?php
	if($_SESSION["compteConnecte"]){
		header("Refresh:0; url=index.php?page=activites");
	}
?>
<div class="background">
	<div class="partie1">
		<div style="text-align: center">Bonjour à toutes et à tous !<br></br>
		Nous sommes "Ok Boomer", notre objectif est simple … proposer des activités pour les personnes âgées afin qu’elles puissent passer un bon moment avec les autres membres de notre groupe.</div>
	</div>
		<div class="inscription">
			<div style="text-align: center"><br></br>
			Première visite sur notre site ? Alors rejoignez nous !<br></br>
			<a href="index.php?page=inscription"><h2>INSCRIPTION</h2> <br></br></a>
			</div>
		</div>
		<div class="connexion"><br></br>
			<div style="text-align: center">
			Déjà inscris ? Alors connectez-vous immédiatement !<br></br>
			<a href="index.php?page=connexion"><h2>CONNEXION</h2> <br></br></a>
		</div>
	
</div>


