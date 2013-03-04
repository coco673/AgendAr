<?php 
$nom = $_POST['login'];
$pass = $_POST['pass'];

try {
	$dsn = 'mysql:host=tonycoriolle;dbname=tonycoriolle';
	$connection = new PDO($dsn, 'tonycoriolle', '25362536');
} catch(PDOException $e) {
	die('Erreur : '.$e->getMessage());
}
$requete = $connection->query('SELECT * FROM membres');
$trouve = false;
while($donnee = $requete->fetch()) {
	if($nom == $donnee['login'] && $pass==$donnee['pass']){
	$trouve = true;
	break;
	}	
}
if ($trouve) {
echo "ok";
}else {
echo "pas de concordance";
}
?>