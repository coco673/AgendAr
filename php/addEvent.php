<?php 
session_start();
	//Connection a la base de Donnée. 
	include('connection.php');
	//On vérifie que les variables existent.
	if(isset($_POST['date']) || isset($_POST['debut']) || isset($_POST['fin']) 
		|| isset($_POST['titre']) || isset($_POST['desc'])) {
				$currentDate = new DateTime();
			//On Supprime tous les espaces si il y en a. 
			$date = str_replace(" ","",$_POST['date']);
			$debut = str_replace(" ","",$_POST['debut']);
			$fin = str_replace(" ","",$_POST['fin']);
			//On Parse les String pour récupérer les données qui nous intéressent.
			$jour = intval(substr($date, 0, 2));
			$mois = intval(substr($date, 3, 2));
			$annee = intval(substr($date, 6, 4));
			
			$heureDebut = intval(substr($debut, 0, 2));
			$minDebut = intval(substr($debut, 3, 2));
			$heureFin = intval(substr($fin, 0, 2));
			$minFin = intval(substr($fin, 3, 2));
			unset($debut);
			unset($fin);
			
			//On prepare les variables à être passer dans les requêtes SQL 
			//en ajoutant des quotes.
			$dateEvent = new DateTime();
			$dateEvent->setDate($annee,$mois,$jour);
			$dateEvent->setTime($heureDebut,$minDebut);
			
			$endDateEvent = new DateTime();
			$endDateEvent->setDate($annee,$mois,$jour);
			$endDateEvent->setTime($heureFin,$minFin);
			
			if($currentDate->getTimeStamp()>$dateEvent->getTimeStamp()){
			echo"Vous ne pouvez ajouter un évenement à une date déjà passé";
			} else {
			$titre = $connection->quote($_POST['titre'],PDO::PARAM_STR);
			$desc = $connection->quote($_POST['description'],PDO::PARAM_STR);
			$pseudo = $connection->quote($_SESSION['pseudo'],PDO::PARAM_STR);
			$requete = $connection->query("SELECT * FROM members WHERE pseudo = $pseudo");
			 
			 while($donnee = $requete->fetch()){
				$id=$donnee['id'];
			 }
			 $id = intval($id);
			$requete = $connection->exec("INSERT INTO event(user_id, date, finEvent, titre, description) VALUES($id,'".$dateEvent->format('Y-m-d H:i')."', '".$endDateEvent->format('H:i:s')."', $titre, $desc)");
			header("location: ../index.php");
		}
	}
?>