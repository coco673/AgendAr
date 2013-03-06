<?php 
$login = $_POST['login'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$pays = $_POST['pays'];
$pseudo = $_POST['pseudo'];

if($login == "" || $pass1 == "" || $pass2=="" || $pays== ""||$pseudo="") {
	echo "<script type='text/javascript'> window.alert('Tous les champs ne sont pas remplits'); document.location.href='../Inscription.php';</script>";
} else {
include('connection.php');
$requete = $connection->query('SELECT login,pseudo FROM members');
$exist = false;
while($donnee = $requete->fetch()){
	if($donnee['login'] == $login || $donnee['pseudo'] == $pseudo){
	$exist = true;
	break;
	}
}
if($exist == false) {
	if($pass1 == $pass2){
	$login = $connection->quote($_POST['login']);
	$pseudo = $connection->quote($_POST['pseudo']);
	$pass1 = hash("sha256", $pass1);
	$pass1 = $connection->quote($pass1);
	$pays = $connection->quote($_POST['pays']);	

		$requete = $connection->exec("INSERT INTO members(login, pass, pays, pseudo) VALUES ($login, $pass1, $pays,$pseudo)");
		header("location: ../index.php");
	} else {
	echo "<script type='text/javascript'> window.alert('les mots de passes sont differents');</script>";
	}
} else {
	echo "<script type='text/javascript'> alert('login d\351j\340 utilis\351');</script>";
	}
}
?>