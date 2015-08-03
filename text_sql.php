<?php
//CODIGO,NOMEPRODUTO,GRUPO,FABRICANTE,DESCRICAO_COMPLEMENTAR,REFERENCIA,PRECO
$conn = mysql_connect("localhost","root","123");
$db = mysql_select_db("teste_gmi",$conn);
$handle = fopen("produtos.csv", "r");
$q = mysql_query("SELECT * FROM gmi_produtos");
$total = mysql_num_rows($q);
$codes = array();
$codes_add = array();

for($i = 0; $i < $total; $i++) {
	$row = mysql_fetch_array($q);
	$codes[] = $row['CODIGO'];
}

while(($data = fgetcsv($handle, 1000, ",")) !== false) {
	if($data[0] != 0):
		if(in_array($data[0],$codes)) {
			mysql_query("UPDATE gmi_produtos SET NOMEPRODUTO = '$data[1]', GRUPO = '$data[2]', FABRICANTE = '$data[3]', DESCRICAO_COMPLEMENTAR = '$data[4]', REFERENCIA = '$data[5]',  PRECO = '$data[6]' WHERE CODIGO = '$data[0]'");
		}
		else {
			mysql_query("INSERT INTO gmi_produtos SET CODIGO = '$data[0]', NOMEPRODUTO = '$data[1]', GRUPO = '$data[2]', FABRICANTE = '$data[3]', DESCRICAO_COMPLEMENTAR = '$data[4]', REFERENCIA = '$data[5]',  PRECO = '$data[6]'");
			echo $data[0] . " foi inserido<br>";
		}
		$codes_add[] = $data[0];
	endif;
}

for($i = 0; $i < count($codes); $i++) {
	if(!in_array($codes[$i],$codes_add)) {
		mysql_query("DELETE FROM gmi_produtos WHERE CODIGO = '$codes[$i]'");
		echo "{$codes[$i]} foi excluído<br>";
	} else {
		echo "{$codes[$i]} foi atualizado<br>";
	}
}

echo count($codes_add) . " linhas foram lidas no csv<br>";
echo "Concluído";

fclose($handle);
mysql_close($conn);

?>   