<?php

include 'db.php';

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=weka_goaline.csv");
header("Pragma: no-cache");
header("Expires: 0");

$res=$db->query("SELECT * FROM `v_jogos_com_odds`");


echo "sg,sc,sda,ss,goaline_diff,probU,probO,pl_over,pl_under\n";

while( $e=mysqli_fetch_assoc($res) ){
	$sg=((int)$e['gh']) + ((int)$e['ga']);
	$sc=((int)$e['ch']) + ((int)$e['ca']);
	$sda=((int)$e['dah']) + ((int)$e['daa']);
	$ss=((int)$e['sh']) + ((int)$e['sa']);
	$goaline_diff = ((float)$e['goalline'])- $sg;
	$oo=(float) $e['oo'];
	$ou=(float) $e['ou'];
	$probO=1/$oo/(1/$oo+1/$ou);
	$probU=1-$probO;	
	$ghf=(int)$e['ghf'];
	$gaf=(int)$e['gaf'];	
	$sgf=$ghf+$gaf;	
	$diff=$sgf-( (float)$e['goalline'] );
	$pl_o= $diff<=-0.5 ? -1 : ($diff==-0.25 ? -0.5 :( $diff==0 ? 0 : ($diff==0.25 ? ($oo-1)/2 : $oo-1)));
	$pl_u= $diff>=0.5 ? -1 : ($diff==0.25 ? -0.5 :( $diff==0 ? 0 : ($diff==-0.25 ? ($ou-1)/2 : $ou-1)));
	
	echo "$sg,$sc,$sda,$ss,$goaline_diff,$probU,$probO,$pl_o,$pl_u\n";
}