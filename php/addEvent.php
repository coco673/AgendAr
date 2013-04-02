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
			unset($date);
			
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
			if($currentDate->getTimeStamp()>$dateEvent->getTimeStamp()){
			echo"je t'encule Therèse !!!!!!!";//TODO
			} else {
			$jour = $connection->quote($jour,PDO::PARAM_INT);
			$mois = $connection->quote($mois,PDO::PARAM_INT);
			$annee = $connection->quote($annee,PDO::PARAM_INT);
			$heureDebut = $connection->quote($heureDebut,PDO::PARAM_INT);
			$minDebut = $connection->quote($minDebut,PDO::PARAM_INT);
			$heureFin = $connection->quote($heureFin,PDO::PARAM_INT);
			$minFin = $connection->quote($minFin,PDO::PARAM_INT);
			$titre = $connection->quote($_POST['titre'],PDO::PARAM_STR);
			$desc = $connection->quote($_POST['description'],PDO::PARAM_STR);
			$pseudo = $connection->quote($_SESSION['pseudo'],PDO::PARAM_STR);
			$requete = $connection->query("SELECT * FROM members WHERE pseudo = $pseudo");
			 
			 while($donnee = $requete->fetch()){
				$id=$donnee['id'];
			 }
			 $id = intval($id);
			$requete = $connection->exec("INSERT INTO Event(user_id,jour,mois,annee,heure_debut,min_debut,heure_fin,min_fin,titre,description) VALUES($id,$jour,$mois,$annee,$heureDebut,$minDebut,$heureFin,$minFin,$titre,$desc)");
		header("location: ../index.php");
		}
	}
?>