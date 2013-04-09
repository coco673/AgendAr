<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<title>Agendar</title>
<script type="text/javascript" src="javascript/calendrier.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<meta http−equiv="refresh" content="1" />
<script>

	function getLabl(type, valy, valm , vald){
		tab_mois = new Array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
		if(type=="year"){
			return (valy);
		} else if(type == "mon") {
			return tab_mois[valm-1]+' '+valy;
		} else if(type == "week"){
			return 'Semaine du '+ vald +' '+tab_mois[(valm-1)]+' '+valy;
		}
	}
	
	function goToMonth(valm){
		tp = "mon";
		valy = $("#choiceLink").attr("valy");
		vald = 1;
		$.ajax({
			type: "GET",
			url:"calendrier.php?type="+tp+"&valy="+valy+"&valm="+valm+"&vald="+valm ,
			dataType:"html",
			error:function(msg, string){
				alert("Error !:"+string);
			},
			success:function(data){
				$("#calendrier").slideToggle().empty().append(data).slideToggle();
				$("#choiceLink").slideToggle().attr("tp",tp).attr("valy",valy).attr("valm",valm).attr("vald",vald).text(getLabl(tp,valy,valm,vald)).slideToggle();
			}
		});
	}
	
	function prevWeek(vald, valm, valy){
		if(vald - 7 <= 0){
			if(valm == 1){
				return 12;
			} else {
				return (parseInt(valm)-3);
			}
		} else {
			return valm;
		}
	}
	
	function nextWeek(vald, valm, valy){
		nb_jours_mois = new Array(31,29,31,30,31,30,31,31,30,31,30,31);
		if(((valy % 4 == 0) && (valy % 100 != 0)) || (valy % 400 == 0)){
			nb_jours_mois[1] = 29;
		} else {
			nb_jours_mois[1] = 28;
		}
		if(parseInt(vald) + 7 > nb_jours_mois[(valm-1)]){
			if(valm >= 12){
				return 1;
			} else {
				return parseInt(valm) + 2;
			}
		} else {
			return valm;
		}
	}
	
	function goToWeek(vald){
		tp = "week";
		valy = $("#choiceLink").attr("valy");
		valm = $("#choiceLink").attr("valm");
		$.ajax({
			type: "GET",
			url:"calendrier.php?type="+tp+"&valy="+valy+"&valm="+valm+"&vald="+vald ,
			dataType:"html",
			error:function(msg, string){
				alert("Error !:"+string);
			},
			success:function(data){
				$("#calendrier").slideToggle().empty().append(data).slideToggle();
				$("#choiceLink").slideToggle().attr("tp",tp).attr("valy",valy).attr("valm",valm).attr("vald",vald).text(getLabl(tp,valy,valm,vald)).slideToggle();
			}
		});
	}
	
	function getPrevDay(valy,valm,vald){
		nb_jours_mois = new Array(31,29,31,30,31,30,31,31,30,31,30,31);
		if(((valy % 4 == 0) && (valy % 100 != 0)) || (valy % 400 == 0)){
			nb_jours_mois[1] = 29;
		} else {
			nb_jours_mois[1] = 28;
		}
		if(valm != 1){
			return (nb_jours_mois[(parseInt(valm)-2)] - (7 - vald));
		} else {
			return (nb_jours_mois[11] - (7 - parseInt(vald)));
		}
	}
	
	function getNextDay(valy,valm,vald){
		nb_jours_mois = new Array(31,29,31,30,31,30,31,31,30,31,30,31);
		if(((valy % 4 == 0) && (valy % 100 != 0)) || (valy % 400 == 0)){
			nb_jours_mois[1] = 29;
		} else {
			nb_jours_mois[1] = 28;
		}
		if(valm == 11){
			return (8 - ( 31 - vald));
		}
		if(vald == 31){
			return 7;
		} else {
			return (7 -(nb_jours_mois[(parseInt(valm) - 1)]-vald));
		}
	}
	
	$(document).ready(function(){	
		$(".navi").click(function(){
			tp = $(this).attr("name");
			valy = $("#choiceLink").attr("valy");
			valm = $("#choiceLink").attr("valm");
			vald = $("#choiceLink").attr("vald");
			if(tp != $("#choiceLink").attr("tp")){
				$.ajax({
					type: "GET",
					url:"calendrier.php?type="+tp+"&valy="+valy+"&valm="+valm+"&vald="+valm ,
					dataType:"html",
					error:function(msg, string){
						alert("Error !:"+string);
					},
					success:function(data){
						$("#calendrier").slideToggle().empty().append(data).slideToggle();
						$("#choiceLink").slideToggle().attr("tp",tp).attr("valy",valy).attr("valm",valm).attr("vald",vald).text(getLabl(tp,valy,valm,vald)).slideToggle();
					}
				});
			} 
		});
		
		
		
		$(".chooser").click(function(){
			tp = $("#choiceLink").attr("tp");
			valy = $("#choiceLink").attr("valy");
			valm = $("#choiceLink").attr("valm");
			vald = $("#choiceLink").attr("vald");
			req = $(this).attr("name");
			
			if(req == "pre"){
				if(tp == "year"){
					valy--;
				} else if (tp == "mon"){
					if(valm <= 1){
						valm = 12;
						valy--;
					} else {
						valm--;
					}
				} else if (tp == "week"){
					if(valm < prevWeek(vald,valm,valy)){//Si on passe au mois de Decembre
						vald = getPrevDay(valy,valm,vald);
						valm = 12;
						valy--;
					} else if (valm > prevWeek(vald,valm,valy)){ // Si on passe au mois precedent mais pas Decembre
						vald = getPrevDay(valy,valm,vald);
						valm --;
					} else { //Si on reste au même mois.
						vald = parseInt(vald) - 7;
					}
				}
			} else if (req == "next"){
				if(tp == "year"){
					valy++;
				} else if (tp == "mon"){
					if(valm >= 12){
						valm = 1;
						valy++;
					} else {
						valm++;
					}
				} else if (tp == "week"){
					if(valm > nextWeek(vald,valm,valy)){//Si on passe au mois de janvier
						vald = parseInt(getNextDay(valy,(valm-1),(vald-1)));
						valm = 1;
						valy++;
					} else if (parseInt(valm) < parseInt(nextWeek(vald,valm,valy))){ // Si on passe au mois suivant mais pas janvier
						vald=getNextDay(valy,valm,vald);
						valm++;
					} else { //Si on reste au même mois.
						vald = parseInt(vald) + 7;					
					}
				}
			}
			
			$.ajax({
				type: "GET",
				url:"calendrier.php?type="+tp+"&valy="+valy+"&valm="+valm+"&vald="+vald ,
				dataType:"html",
				error:function(msg, string){
					alert("Error !:"+string);
				},
				success:function(data){
					$("#calendrier").hide().empty().append(data).show();
					$("#choiceLink").hide().attr("valy",valy).attr("valm",valm).attr("vald",vald).text(getLabl(tp,valy,valm,vald)).show();
				}
			});
		});
	})
</script>
</head>
<body>
	<?php if(isset($_SESSION['pseudo'])) {
    include './php/bandeau/enteteConnected.php';
    } else {
    include './php/bandeau/entete.php';
    }
    ?>
	<section id="navCal">
		
		
		<a href="#" class="chooser" name="pre"> < </a>
		<a href="#" class ="chooser" name="next" link=#> > </a>
		
		<article id="choice">
			<?php
			$tab_mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
			
			$date = new DateTime();
			echo '<a id="choiceLink" tp="mon" valy="'.$date->format("Y").'" valm="'.$date->format("m").'" vald="'.$date->format("d").'">'.$tab_mois[$date->format("n")-1].' '.$date->format("Y").'</a>';
			?>
		</article>
		
		<nav>
			<a href="#" class="navi" id="active" name="year"> Year </a>
			<a href="#" class="navi" name="mon"> Month </a>
			<a href="#" class="navi" name="week"> Week </a>
		</nav>
			
		<div id="calendrier">
			<?php
				include './calendrier.php';
			?>
		</div>
		<article id="date">	
			<script>
				document.write(datedujour());
			</script>
		</article>
		<article id="time">
			<script>
			time();
			</script>
		</article>
	</section>
	<div id='asideL'>
		<?php if(isset($_SESSION['pseudo'])) {
		include('php/connection.php');
		echo"<table border='1'>	<th>mes prochains évents</th>";
		$pseudo = $connection->quote($_SESSION['pseudo']);
		$requete = $connection->query("SELECT id FROM members WHERE pseudo=$pseudo");
		while($donnee=$requete->fetch()){
			$id=$donnee['id'];
		}
		
		$id=intval($id);
		$requete = $connection->query("SELECT * FROM event WHERE user_id=$id and date >= CURRENT_DATE AND date <= CURRENT_DATE + 7");	
	
		while($donnee = $requete->fetch()){
			echo"<tr><td> {$donnee['date']} : {$donnee['description']} </td></tr>";
		}
		echo"</table>";
		}
		?>
	</div>
	<div id='asideR'>
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