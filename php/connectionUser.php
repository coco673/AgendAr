<?php
session_start();
$nom = $_POST['login'];
$pass = $_POST['pass'];

include('connection.php');
$requete = $connection->query('SELECT * FROM members');
$exist = false;
while($donnee = $requete->fetch()) {
	if($nom == $donnee['login'] && hash("sha256", $pass)==$donnee['pass']){
	$exist = true;
	break;
	}	
}
if($exist) {
$_SESSION['pseudo']= $donnee['pseudo'];
echo "<script type='text/javascript'> document.location.href='../index.php';</script>";

} else {
$date = new DateTime();
$ip=$_SERVER['REMOTE_ADDR'];
error_log($ip." | ".$date->format('d-m-Y')." | ".$date->format('h:i:s')."|\n",3,"./erreur.log");

echo "<script type='text/javascript'> window.alert('Utilisateur ou mot de passe inconnu'); document.location.href='../index.php'</script>";
}

?>