<?php 
try{
	$dsn = 'mysql:host=localhost;dbname=CalendrierWeb';
	$connection = new PDO($dsn, 'root', '');
} catch(PDOException $e) {
	die('Erreur : '.$e->getMessage());
}
?>