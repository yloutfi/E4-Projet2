<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=OkBoomer', 'root', '');}
	catch (Exception $e) {
    die("L'accès à la base de donnée est impossible.");}
    ?>
<?php
// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, messages, heureMessage FROM tchat ORDER BY heureMessage DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch()){
    echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : '. $donnees['heureMessage'] .'</br>' htmlspecialchars($donnees['messages']) .'</p>';
}?>
	
    <?php
$reponse->closeCursor();

?>