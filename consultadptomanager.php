<?php

	require('session.php');
	
	// $idemp = $_SESSION['iduser'];
	$idemp = $_POST['empleado'];
	
	$selectDpto = "SELECT departments.dept_name FROM departments, dept_emp WHERE departments.dept_no = dept_emp.dept_no AND dept_emp.emp_no = $idemp AND dept_emp.to_date = '9999-01-01';";
	$departamento = mysqli_query($conn, $selectDpto);
	$dpto = mysqli_fetch_array($departamento, MYSQLI_NUM);
	
	echo "El departamento al que usted corresponde es: <b>$dpto[0]</b><br>";
	
	echo "<a href='welcomemanager.php'>VOLVER</a><br>";
	
?>