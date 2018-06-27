<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');




$data=new DateTime();
$data->modify('-1 day');

//Data de ontem no formato YYYMMDD
$ontem=$data->format('Ymd');

//Seleciona a primeira pagina que não tem em jogo associada
$res=$db->query("SELECT data, n_pages FROM pages WHERE data > (SELECT MAX(data_page) FROM jogos ) ORDER BY data LIMIT 1");


$e=mysqli_fetch_assoc($res);

$e['data']=(int) $e['data'];
$e['n_pages']=(int) $e['n_pages'];

echo json_encode($e);



