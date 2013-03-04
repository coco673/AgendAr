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
<?php
	include './php/bandeau/entete.php';
?>
	<section id="calendrier">
		<nav>
			<a href link=#> Month </a>
			<a href link=#> Week </a>
			<a href link=#> Day </a>
		</nav>
		<script>
			lanceSelect();
		</script>
		<article>
			<script>
				calendrier();
			</script>
		</article>
		<aside>
			
		</aside>
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
	<footer>
	</footer>
</body>
</html>