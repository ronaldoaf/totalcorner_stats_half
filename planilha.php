<?php

include 'db.php';


header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");


$res=$db->query("SELECT * FROM `v_jogos_com_odds`");


foreach( mysqli_fetch_assoc($res) as $k=>$e  )  echo $k.';';
echo "\n";


$res->data_seek(0);

while( $linha=mysqli_fetch_assoc($res) ){
	foreach( $linha as $e ){
		echo $e.';';
	}
	echo "\n";
}