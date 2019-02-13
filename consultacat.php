<?php

	require('session.php');
	
	$idemp = $_SESSION['iduser'];
	
	$selectCat = "SELECT title FROM titles WHERE emp_no = $idemp AND to_date = '9999-01-01';";
	$categoria = mysqli_query($conn, $selectCat);
	$cate = mysqli_fetch_array($categoria, MYSQLI_NUM);
	
	echo "Su categoria actual es: <b>$cate[0]</b>";
	
?>