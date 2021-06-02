<?php
	if(!$_SESSION["compteConnecte"]){
		header("Refresh:0; url=index.php?page=accueil");
	}
?>
<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=OkBoomer', 'root', '');}
	catch (Exception $e) {
    die("L'accès à la base de donnée est impossible.");}
    if(isset($_POST['envoyer'])){
        if(!empty($_POST['messages'])){
            $pseudo=$_SESSION["pseudo"];
            $message=nl2br(htmlspecialchars($_POST['messages']));
            $insererMessage=$bdd ->prepare('INSERT INTO tchat(pseudo,messages,heureMessage) values (?,?, NOW()) ');
            $insererMessage->execute (array($pseudo,$message));
    } 
    else{
		echo "Veuillez compléter tous les champs!";
    }
}
?>
 
<doctype html>
    <html>
        <head>
            <title>Messagerie instantanée</title>
            <meta charset="utf-8">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body><?php
echo $_SESSION['id'];?>
<div style="text-align: center">
    <form method ="POST"action ="" >
        <?php echo $_SESSION["pseudo"];?>
        <br><br>
        <textarea name="messages"></textarea>
        <br>
        <input type="submit" name="envoyer">
    </form></div>
<section id="message"></section>
<?php
// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, messages, heureMessage FROM tchat ORDER BY heureMessage DESC LIMIT 1, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch()){
    echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> '. $donnees['heureMessage'] .':</br>' . htmlspecialchars($donnees['messages']) .'</p>';
}?>

    <?php
$reponse->closeCursor();
?>

</body>
    </html>