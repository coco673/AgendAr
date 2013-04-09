<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<title>Mes Pr&eacute;f&eacute;rence</title>
<script type="text/javascript" src="javascript/calendrier.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="" />
</head>
	<body>

<table>
<tr>
<?php 
$i=1;
$nombre_ligne = 18;   		
for($rouge=0; $rouge<=5;$rouge++){
	for($vert = 0; $vert <=5; $vert++){
    	for($bleu =0; $bleu <=5; $bleu++){
    		$rouge_hex = str_pad(dechex($rouge*51),2,"0",STR_PAD_LEFT);
    		$vert_hex = str_pad(dechex($vert*51),2,"0",STR_PAD_LEFT);
    		$bleu_hex = str_pad(dechex($bleu*51),2,"0",STR_PAD_LEFT);
    		$couleur_hex = $rouge_hex . $vert_hex . $bleu_hex;
			print("<td bgcolor='#$couleur_hex' width='15'>&nbsp;</td>");
 			if(($i%$nombre_ligne) == 0){
    			print("</tr><tr>");
    		}
    		$i++;
    	}
    }
}
?>
</tr>
</table>


</body>
</html>