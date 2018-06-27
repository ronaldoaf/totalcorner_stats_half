<?php

include 'db.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$obj=json_decode( file_get_contents('php://input'), true );

foreach($obj as $k=>$v){
	$ks[]=$k;
	$vs[]=$v;
}

$SQL= 'INSERT IGNORE INTO odds ('.join(',', $ks).') VALUES ('.join(',', $vs).');';

$SQL= str_replace(',,', ',-1,', $SQL);



$db->query($SQL);

