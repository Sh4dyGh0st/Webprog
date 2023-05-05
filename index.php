<?php
include('./includes/config.inc.php');

// oldalak keresés php , ha nem talál hiba

$keres = $oldalak['/'];
if (isset($_GET['oldal'])) {
	if (isset($oldalak[$_GET['oldal']]) && file_exists("./templates/pages/{$oldalak[$_GET['oldal']]['fajl']}.tpl.php")) {
		$keres = $oldalak[$_GET['oldal']];
	}
	else { 
		$keres = $hiba_oldal;
		header("HTTP/1.0 404 Not Found");
	}
}


// adatok összegyűjtése:képfeltöltés mappa

$kepek = array();
$olvaso = opendir($MAPPA);
while (($fajl = readdir($olvaso)) !== false) {
if (is_file($MAPPA.$fajl)) {
$vege = strtolower(substr($fajl, strlen($fajl)-4));
$kepek[$fajl] = filemtime($MAPPA.$fajl);
}
}
closedir($olvaso);



$uzenet = array();   

    // Űrlap ellenőrzés:képfeltöltésnél
    if (isset($_POST['kuld'])) {
        //print_r($_FILES);
        foreach($_FILES as $fajl) {
            if ($fajl['error'] == 4);   // Nem töltött fel fájlt
            elseif (!in_array($fajl['type'], $MEDIATIPUSOK))
                $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
            
                        
                
            else {
                $vegsohely = $MAPPA.strtolower($fajl['name']);
                if (file_exists($vegsohely))
                    $uzenet[] = " Már létezik: " . $fajl['name'];
                else {
                    move_uploaded_file($fajl['tmp_name'], $vegsohely);
                    $uzenet[] = ' Ok: ' . $fajl['name'];
                }
            }
        }        
    }

include('./templates/index.tpl.php'); 
?>