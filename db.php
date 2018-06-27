<?php



//$db = pg_connect('host=localhost port=5432 dbname=aposteme_odds user=aposteme password=RR842135$ucess@1') or die('Falhou a conexão com o Banco');





$db = new mysqli('localhost', 'apost397_half', 'rr842135', 'apost397_half');

function erro($res, $linha){
	global $db;
	
	if (!$res) {
	  $resposta='<br><br><b>ERROR:</b> ' . $db->error . ".    line: <b>$linha</b><br><br>";
	  $resposta=time()."<br>".$resposta;
	  
	  
	  file_put_contents('db_erro.html', $resposta, FILE_APPEND );
	  
	  
	  return true;
	}
	return false;

}




function insertArray($array, $tabela){
	global $db;
	
	
	
	foreach($array[0] as $campo => $valor){
			$campos.=$campo.",";
	}
	$campos=rtrim($campos, ",");			
	$SQL="INSERT IGNORE INTO $tabela ($campos) VALUES ";		
	
	foreach($array as $linha){
		$valores='';
		foreach($linha as $campo => $valor){				
			
			//Remove caracteres que podem causar problema
			$valor=str_replace(',', ' ', $valor );
			$valor=str_replace(';', ' ', $valor );
			$valor=str_replace("'", '', $valor );			
			
			//Se for string coloca as aspas
			if (gettype($valor)=='string') $valor="'$valor'";
			
			$valores.=$valor.",";
		}

		//Remove a última vírgula que está sobrando
		
		$valores=rtrim($valores, ",");
		

		$SQL.="($valores),";
		
		
	}
	$SQL=rtrim($SQL, ",");
	
	$db->multi_query($SQL);
	
	return($db->affected_rows);
	
}




function insertArray2($array, $tabela){
	global $db;
	
	$SQL="";
	foreach($array as $linha){
		$campos='';
		$valores='';
		foreach($linha as $campo => $valor){
			$campos.=$campo.",";			
			
			
			//Remove caracteres que podem causar problema
			$valor=str_replace(',', ' ', $valor );
			$valor=str_replace(';', ' ', $valor );
			$valor=str_replace("'", '', $valor );			
			
			//Se for string coloca as aspas
			if (gettype($valor)=='string') $valor="'$valor'";
			
			$valores.=$valor.",";
		}

		//Remove a última vírgula que está sobrando
		$campos=rtrim($campos, ",");
		$valores=rtrim($valores, ",");
		

		$SQL.="INSERT IGNORE INTO $tabela ($campos) VALUES ($valores);";
	}
	
	$db->multi_query($SQL);
	
	return($db->affected_rows);
	
}



//$db->query('SELECT * FROM ligas');

//$db->query( "INSERT INTO stats VALUES(1111111111,'brazil', 'serie A','palmeiras','santos',0.777777777)" );



/*
$result=$db->query('SELECT sel, odd FROM t_palpites WHERE ativo =1 ORDER BY timestamp DESC');


while($exibe = mysqli_fetch_assoc($result) ){
  $p=$exibe['sel'];
  $o=$exibe['odd'];
  
  echo "<a target='_blank' href='http://www.allsport365.com/instantbet/default.asp?participantid=$p&odds=$o'>$p</a><br>";
}



*/

?>