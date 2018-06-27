<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');



$obj=json_decode( file_get_contents('php://input') );





$SQL="INSERT INTO pages (data, n_pages) VALUES ({$obj->data}, {$obj->n_pages});";
$db->query( $SQL );

echo $SQL;


