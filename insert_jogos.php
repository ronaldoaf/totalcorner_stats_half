<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');


function ajuste($str){
	return str_replace(["'",","],'', $str);

}


$obj=json_decode( file_get_contents('php://input') );


foreach($obj as $j){
	if (($j->dah==0) && ($j->daa==0) ) continue;
	$linhas[]='('.join(',', [$j->id, "'".$j->data_inicio."'", "'".ajuste($j->home)."'", "'".ajuste($j->away)."'", 	$j->ghf,  $j->gaf,  $j->ch, $j->ca, $j->dah, $j->daa, $j->sh, $j->sa, $j->data_page]).')';

}

$SQL= 'INSERT IGNORE INTO jogos VALUES '. join(',',  $linhas);

//echo $SQL;

$db->query($SQL);