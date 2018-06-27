<?php

include 'db.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');




$data=new DateTime();
$data->modify('-1 day');

//Data de ontem no formato YYYMMDD
$ontem=$data->format('Ymd');


$res=$db->query("SELECT MAX(data) AS data FROM pages");

$e=mysqli_fetch_assoc($res);

if ( ((int)$e['data'])>=((int)$ontem)   ) {
	echo '-1';
	exit();

}


$data=DateTime::createFromFormat('Ymd', $e['data']);
$data->modify('+1 day');
echo $data->format('Ymd');