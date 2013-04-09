<?php

	function concatWeek($currDay, $currMonth, $currYear){
		$d = new DateTime("".$currYear."-".$currMonth."-".$currDay."");
		$tab_mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
		
		if(($d->format("d"))-($d->format("N")) >= 0){ /*Si le lundi de la semaine appartient au meme mois*/
			if(($d->format("d") + (7 - ($d->format("N") - 1)) <= $d->format("t"))){ /*et que le dimanche aussi*/
				echo ''.($currDay - ($d->format("N") - 1)).' '.$tab_mois[$currMonth-1].' '.$currYear.' au '.($currDay +(7-($d->format("w") - 1))).' '.$tab_mois[$currMonth-1].' '.$currYear;
			} else { /*mais que la semaine se termine le mois suivant*/
				echo ''.($currDay - ($d->format("N")-1)).' '.$tab_mois[$currMonth-1].' '.$currYear.' au '.(($d->format("d")+(7 -($d->format("N") - 1)))-$d->format("t")).' ';
				if($curMonth < 12){ /*Si ce n'est pas le mois de décembre*/
					echo ''.$tab_mois[$currMonth].' '.$currYear;
				} else { /*Si la semaine fini en janvier de l'année suivante*/
					echo ''.$tab_mois[0].' '.($currYear + 1);
				}
			}
		} else { /*Si la semaine commence au mois précédent*/
			if($currMonth > 1){ /*et que nous ne sommes pas en Janvier*/
				$d2 = new Date($currYear."-".($currMonth - 1)."-".(1));
				echo ''.($d2->format("t")-(($d->format("N")-1) - $d->format("d"))).''.$tab_mois[11].''.($currYear - 1);
			} else { /*Qu'elle commence l'année précédente*/
				echo ''.(31-(($d->format("N")-1) - $d->format("d"))).''.$tab_mois[11].''.($currYear - 1);
			}
			echo ' au '.($d->format("d") + (7 - $d->format("N"))).''.$tab_mois[$currMonth-1].''.$currYear;
		}
	}
	if(isset($_GET['type']) && isset($_GET['vald']) && isset($_GET['valm']) && isset($_GET['valy'])){
		$type = $_GET['type'];
		$vald = $_GET['vald'];
		$valm = $_GET['valm'];
		$valy = $_GET['valy'];
	} else {
		$date = new DateTime();
		$type = "mon";
		$vald = $date->format("j");
		$valm = $date->format("n");
		$valy = $date->format("Y");
	}
	$tab_mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
	
	/*On génère le calendrier qui nous interresse*/
	if($type == "mon"){
		calendarMonth($valy, $valm);
	} else if($type == "year"){
		calendarYear($valy);
	} else if($type == "week"){
		calendarWeek($valy, $valm, $vald);
	}

	function calendarYear($valy){
		$tab_mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
		echo '<table><tbody><tr>';
		$date = new DateTime();
		for($i = 1; $i <= 12 ; $i++){
			if($valy == $date->format("Y") && $i == $date->format("m")){
				echo '<td class="month" id="currMonth" valm="'.$i.'" onClick="goToMonth('.$i.')">'.$tab_mois[$i -1].'</td>';
			} else {
			echo '<td class="month" valm="'.$i.'" onClick="goToMonth('.$i.')">'.$tab_mois[$i -1].'</td>';
			}
			if($i != 0 && $i % 4 == 0 && $i != 12){
				echo '</tr><tr>';
			}
		}	
		echo '</tr><tbody></table>';
	} 
	
	function calendarMonth($valy, $valm){
		$currDate = new DateTime();
		$date = new DateTime();
		$date->setDate($valy,$valm,1);
		$tab_jours = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
		echo'<table><thead><tr>';
		//THEAD
		for($i = 0; $i < 7 ; $i++){
			echo'<th>'.$tab_jours[$i].'</th>';
		}
		echo '</tr></thead><tbody><tr>';
		//TBODY

		if($date->format("N") > 1){
			$date2 = $date;
			$date2->modify('-'.($date->format("N")-1).'days');
			for($i = $date2-> format("j"); $i <= $date2->format("t"); $i++){
				echo '<td>'.$i.'</td>';
			}
		}
		$date = new Datetime();
		$date->setDate($valy,$valm,1);
		for($i = 1; $i <= $date->format("t"); $i++){
			if($date->format("N") >= 6){
				if($date == $currDate){
					echo '<td class="currDay" onclick="goToWeek('.$i.')">'.$i.'</td>';
				} else {
					echo'<td class="weekend" onclick="goToWeek('.$i.')">'.$i.'</td>';
				}
				if($date->format("N") == 7 && $date->format("j") != $date->format("t")){
					echo'</tr><tr>';
				}
			} else {
				if($date == $currDate){
					echo '<td class="currDay" onclick="goToWeek('.$i.')">'.$i.'</td>';
				} else {
					echo '<td class="jour" onclick="goToWeek('.$i.')">'.$i.'</td>';
				}
			}
			if($i != $date->format("t")){
				$date->modify("+1 day");
			}
		}	
		$j = 1;
		if($date->format("N")){
			for($i = $date->format("N"); $i < 7 ; $i++){
				echo '<td>'.$j.'</td>';
				$j++;
			}
		}
		echo '</tr></tbody></table>';
	}

	function calendarWeek($valy, $valm, $vald){
		$date = new DateTime();
		$date->setDate($valy, $valm, $vald);
		$tab_jours = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
		$tab_mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
		echo '<table class="cadre"><thead><tr><th class="hours">Horaires</th>';
		if($date->format("N") != 1){
			$date->modify('-'.($date->format("N")-1).'days');
		}
		for($i = 0; $i < 7; $i++){
			echo '<th class ="headers">'.$tab_jours[$i].' '.$date->format("j").'</br>'.$tab_mois[($date->format("n")-1)].'</th>';
			$date->modify("+1 day");
		}
		echo'<th class ="overflow"></th>';
		echo '</tr></thead><tbody><tr><td colspan="10"><div id="planning"><table></tr>';
		echo '<td class="hours">
			<div class="heures">00h00</div>
			<div class="heures">01h00</div>
			<div class="heures">02h00</div>
			<div class="heures">03h00</div>
			<div class="heures">04h00</div>
			<div class="heures">05h00</div>
			<div class="heures">06h00</div>
			<div class="heures">07h00</div>
			<div class="heures">08h00</div>
			<div class="heures">09h00</div>
			<div class="heures">10h00</div>
			<div class="heures">11h00</div>
			<div class="heures">12h00</div>
			<div class="heures">13h00</div>
			<div class="heures">14h00</div>
			<div class="heures">15h00</div>
			<div class="heures">16h00</div>
			<div class="heures">17h00</div>
			<div class="heures">18h00</div>
			<div class="heures">19h00</div>
			<div class="heures">20h00</div>
			<div class="heures">21h00</div>
			<div class="heures">22h00</div>
			<div class="heures">23h00</div>  
		</td>';
		$date->setDate($valy, $valm, $vald);
		if($date->format("N") != 1){
			$date->modify('-'.($date->format("N")-1).'days');
		}
		$currDate = new DateTime();
		for($i = 1; $i <= 7; $i++){
			if($date==$currDate){
				echo '<td class="day" id="currDay"></td>';
			} else {
				echo '<td class="day" ></td>';
			}
			$date->modify("+1 day");
		}
		echo '</tr></table></div></td></tr></tbody></table>';
	}
?>