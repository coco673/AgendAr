
function time() {
	date = new Date();
	heure = date.getHours();
	min = date.getMinutes();
	sec = date.getSeconds();
	var time ="";
	if(heure < 10){
		heure = "0" + heure;
	}
	if(min < 10){
		min = "0" + min;
	}
	if(sec < 10){
		sec = "0" + sec;
	}
	time = ""+heure+":"+min+":"+sec;
	document.getElementById('time').innerHTML = time;
	setTimeout("time()", 1000); 
}
function datedujour(){
date = new Date();
jour = date.getDate();
var time ="";
var moisLettres = new Array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
var tab_jour=new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");


 if(jour<10){
	jour = "0" + jour;
 }
 time = tab_jour[date.getDay()]+" "+jour+" "+moisLettres[date.getMonth()]+" "+ date.getFullYear();
 return time;
}
function bissextile(year) {
	if((year%4 == 0) && (year%100 != 0)){
		return true;
	} else if(year%400 == 0) {
		return true;
	} else {
		return false;
	}
}

function calendrier() {
	nbJourMois = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	jour = new Array("Lundi","Mardi","Mercredi","Jeudi", "Vendredi", "Samedi","Dimanche");   
	date = new Date();
	
	/*DEBUT DU CALENDRIER*/
		document.write('<table border="1" id="tableau"><thead>');
	
	/*EN TETE*/
		for( i = 0 ; i<=6 ;i++){
			document.write("<th>" + jour[i] + "</th>");
		}
		document.write("</thead>");
	
	/*CORPS*/
		document.write('<tbody>');
		nbJourMois = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
		jour = new Array("Lundi","Mardi","Mercredi","Jeudi", "Vendredi", "Samedi","Dimanche");   
		date = new Date();
		jourDeLaSemaine = date.getDay();
		mois = date.getMonth();
		var day = date.getDate();
		date2 = new Date();
		date2.setDate(1);
		dday = date2.getDay()-1;
		currentDay = jour[jourDeLaSemaine];
		currentNbDayInMonth = nbJourMois[mois];
		currentPosition = day;
		maxMoisPre = nbJourMois[date.getMonth()-1];

		document.write('<tr>');
		for(var day=1;day<=dday;day++){
			avant = maxMoisPre-dday+day;
			document.write('<td>'+avant+'</td>');
		}
		day=1;
		while(dday<=6){
			if(day == date.getDate()){
				document.write('<td class="currDay">'+day+'</td>');
			} else {
				if(dday==5 || dday==6){
					document.write('<td class="weekend">'+day+'</td>');	
				} else {
					document.write('<td class="jour">'+day+'</td>');
				}
			}
			day++;
			dday++;
		}
		document.write('</tr>');
		var i = 1;
		document.write('<tr>');
		for(day; day <= currentNbDayInMonth; day++) {
			if(day == date.getDate()){
				document.write('<td class="currDay">'+day+'</td>');	
				if(i == 7){
					document.write("</tr>");
					i=0;
				} else {}
			} else {
				if(i==6 || i==7){
					document.write('<td class="weekend">'+day+'</td>');	
					if(i==7){
						document.write("</tr>");
						i = 0;
					}
				} else {
					document.write('<td class="jour">'+day+'</td>');
				}
			}
			i++;
		}
	
	/*FIN DU CALENDRIER*/
		document.write('</tr></tbody></table>');
}
function lanceSelect(){
	date = new Date();
	select = date.getMonth();
	var moisLettres = new Array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
	document.write('<a href name="pré" link=#> < </a>');
	document.write('<select id="mois">');
	for (i=0;i<12;i++){
		if(i==select) {
			document.write('<option selected value="'+i+'">'+moisLettres[i]+'</option>');
		}else {
			document.write('<option  value="'+i+'">'+moisLettres[i]+'</option>');
		}
	}
	document.write('</select>');
	document.write('<a href name="next" link=#> > </a>');
}


