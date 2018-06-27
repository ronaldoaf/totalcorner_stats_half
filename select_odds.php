<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');


$SQL="SELECT id AS jogo_id FROM jogos WHERE id > (SELECT MAX(jogo_id) FROM odds ) ORDER BY jogo_id LIMIT 1";
//"SELECT id AS jogo_id FROM jogos WHERE id > (SELECT MAX(jogo_id) FROM odds ) ORDER BY jogo_id LIMIT 1
$res=$db->query($SQL);

$e=mysqli_fetch_assoc($res);

echo $e['jogo_id'];