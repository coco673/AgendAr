<?php 
$login = $_POST['login'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

try{
	$dsn = 'mysql:host=mysql10.000webhost.com;dbname=a3176494_calWeb';
	$connection = new PDO($dsn, 'a3176494_tony', 'corioton95');
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	die('Erreur : '.$e->getMessage());
}
$requete = $connection->query('SELECT login FROM membres');
$exist = false;
while($donnee = $requete->fetch()){
	if($donnee['login'] == $login){
	$exist = true;
	break;
	}
}
if($exist == false) {
	if($pass1 == $pass2){
	$login = $connection->quote($_POST['login']);
$pass1 = $connection->quote($_POST['pass1']);
$pass2 = $connection->quote($_POST['pass2']);	

		$requete = $connection->exec("INSERT INTO membres(login, pass) VALUES ($login, $pass1)");
		header("location: ../index.html");
	} else {
	echo "<script type='text/javascript'> window.alert('les mots de passes sont differents');</script>";
	}
} else {
	echo "<script type='text/javascript'> alert('login d\351j\340 utilis\351');</script>";
	}
?>