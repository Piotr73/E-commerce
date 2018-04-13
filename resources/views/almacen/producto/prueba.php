<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php  
	$a = array(10,2,3,4,5);
	$res = 0;
	$sum = 0;
	$cont = 0;
	for ($i=0; $i < sizeof($a); $i++) { 
		$sum = $sum + $a[$i];
		$cont++;
	}

	$res = $sum + $cont;

	echo "el resultado : $res";
	?>
</body>
</html>