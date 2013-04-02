<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<title>Agendar</title>
<script type="text/javascript" src="javascript/calendrier.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<meta http−equiv="refresh" content="1" />
</head>
<body>

<p>
    <?php if(isset($_SESSION['pseudo'])) {
    include './php/bandeau/enteteConnected.php';
    } else {
    include './php/bandeau/entete.php';
    }
    ?>
</p>

	<section id="calendrier">
		<nav>
			<a href link=#> Month </a>
			<a href link=#> Week </a>
			<a href link=#> Day </a>
		</nav>
		<br/>
		<script>
			lanceSelect();
		</script>
		<article>
			<script>
				calendrier();
			</script>
		</article>
		<article id="date">	
			<script>
				document.write(datedujour());
			</script>
		</article>
		<article id="time">
			<script>
			time();
			</script>
		<article>
	</section>
	<div id='aside'>
		<?php if(isset($_SESSION['pseudo'])) {
		$currentDate = new DateTime();
		include('php/connection.php');
			echo"<table border='1'>	<th>mes prochains évents</th>";
		$pseudo = $connection->quote($_SESSION['pseudo']);
		$requete = $connection->query("SELECT id FROM members WHERE pseudo=$pseudo");
		while($donnee=$requete->fetch()){
			$id=$donnee['id'];
		}
		$id=$connection->quote($id,PDO::PARAM_INT);
		$requete = $connection->query("SELECT * FROM Event WHERE user_id=$id AND annee>=$currentDate->format('Y') AND mois>=$currentDate->format('m') AND jour<=(($currentDate->format('d'))+7) AND jour>=$currentDate->format('d')");
	
		while($donnee = $requete->fetch()){
			echo"<tr><td> {$donnee['jour']}/{$donnee['mois']}/{$donnee['annee']} : {$donnee['description']} </td></tr>";
		}
		echo"</table>";
};
		?>	
		<script type="text/javascript">
			var jour = document.getElementById('body');
			jour.addEventListener("click",function(){;},false);
		</script>
		</div>
		<div id='asideL'>
		<?php if(isset($_SESSION['pseudo'])) {
		echo"<form method='POST' action='php/addEvent.php'>
		<label>Ajouter un evenement</label>
		<ul>
		<li><label> Date</label><input type='text' name='date'/>	</li>
		<li><label> Debut</label><input type='text' name='debut'/>	</li>
		<li><label> Fin</label><input type='text' name='fin'/>	</li>
		<li><label> Titre</label><input type='text' name='titre'/>	</li>
		<li><label> Description</label><textarea type='text' name='description'></textarea></li>
		</ul>
		<input type='submit' name='submit'>
		</form>";
		}
		?>
		</div>
	<footer>
	</footer>
</body>
</html>