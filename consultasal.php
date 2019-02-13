<?php

	require('session.php');
	
	$idemp = $_SESSION['iduser'];
	
	$selectDpto = "SELECT salaries.salary FROM salaries WHERE salaries.emp_no = $idemp AND to_date = '9999-01-01';";
	$departamento = mysqli_query($conn, $selectDpto);
	$dpto = mysqli_fetch_array($departamento, MYSQLI_NUM);
	
	echo "Su salario actual es: <b>$dpto[0]</b> $";
	
?>