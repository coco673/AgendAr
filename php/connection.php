<?php 
try{
	$dsn = 'mysql:host=localhost;dbname=CalendrierWeb';
	$connection = new PDO($dsn, 'root', 'root');
} catch(PDOException $e) {
	die('Erreur : '.$e->getMessage());
}
?>