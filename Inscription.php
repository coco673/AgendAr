<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<title>Inscription</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<meta http−equiv="refresh" content="1" />
</head>
<body>
<?php
	include 'php/bandeau/entete.php';
?>
	<div>
		<form method="POST" action="php/inscription.php" id="formulaireInscription">
			<ul>
				<li><label> Adresse e-mail : </label></li>
				<li><input type ="text" name="login"></input></li>
				<li><label> Mot de passe : </label></li>
				<li><input type ="password" name="pass1"></input></li>
				<li><label> Retapez votre mot de passe : </label></li>
				<li><input type ="password" name="pass2"></input></li>
				<li><label> Pseudo : </label></li>
				<li><input type ="text" name="pseudo"></input></li>
				<li> <label> Votre Pays : </label>
					<select name="pays">
						<option value="france">France</option>
						<option value="angleterre">Angleterre</option>
						<option value="usa">USA</option>		   
					</select>
				</li>
				<li><input type="submit" name="submit" value="Envoyer"	></input></li>
			</ul>
		</form>
	</div>
</body>
</html>