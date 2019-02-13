<?php

	require('session.php');
	
	$idemp = $_SESSION['iduser']; //en este caso no se usa al ser el manager seleccionado el empleado no a el mismo
	$nuevoDepartamento = $_POST['departamento'];
	$empleado = $_POST['empleado'];
	
	
/*Seleccionamos el ultimo departamento en el que está*/  
$selectDpto = "SELECT dept_no, from_date FROM dept_emp WHERE emp_no = $empleado AND to_date = '9999-01-01';";	
$dpto = mysqli_query($conn, $selectDpto);	
$viejoDpto = mysqli_fetch_array($dpto);


/*seleccionamos el nuevo dept_no del nuevo departamento SACAS EL CODIGO DEL DPTO*/
$selectNuevoDpto = "SELECT dept_no FROM departments WHERE departments.dept_name = '$nuevoDepartamento';";
$nuevoDpto = mysqli_query($conn, $selectNuevoDpto);	
$dptoNuevo = mysqli_fetch_array($nuevoDpto);
$variable = $dptoNuevo[0];


/*select para que seleccione si dicho empleado ha estado ya en dicho departamento*/
$selectViejoDpto = "SELECT count(*) as titulo FROM dept_emp WHERE emp_no = $empleado AND dept_no = '$variable';";	
$viejoDepartamento = mysqli_query($conn, $selectViejoDpto);	
$dptoViejo = mysqli_fetch_array($viejoDepartamento);

if ($viejoDpto[0] == $dptoNuevo[0]){ //comprobamos si esta en el mismo departamento
	echo "esta en el mismo departamento, espabila";
	mysqli_rollback($conn);
	die();
} else if($dptoViejo[0] == 1){ //comprobamos si se ha cambiado ya hoy 
			echo "No se puede volver a mover a ese empleado a $nuevoDepartamento porque ya ha estado en él.";
			mysqli_rollback($conn);
			die(); 
} else {

		/*Si todo es correcto, cambiamos el nuevo departamento*/
		$sentenciaCambiarDpto = mysqli_prepare($conn, "UPDATE dept_emp SET to_date = curdate() WHERE emp_no = ? AND from_date = '$viejoDpto[1]';");
		mysqli_stmt_bind_param($sentenciaCambiarDpto, 'i', $empleado);
		mysqli_stmt_execute($sentenciaCambiarDpto);

		/*Creamos un nuevo registro con el nuevo departamento*/
		$sentenciaDpto = mysqli_prepare($conn, "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES (?,?,curdate(),'9999-01-01');");
		mysqli_stmt_bind_param($sentenciaDpto, 'is', $empleado, $dptoNuevo[0]);
		mysqli_stmt_execute($sentenciaDpto);
		
		/*seleccionamos el nombre del departamento viejo para mostrarlo en el echo*/
		$selectDpto2 = "SELECT dept_name FROM departments WHERE dept_no = '$viejoDpto[0]';";
		$dpto2 = mysqli_query($conn, $selectDpto2);	
		$dptoEscribir = mysqli_fetch_array($dpto2);
		
	echo "<p style='color: red;'>Se ha cambiado el nuevo departamento correctamente.</p><br>";
	echo "El empleado: <b>$empleado</b>, ha pasado de:<b> $dptoEscribir[0] </b>, al nuevo departamento de: <b> $nuevoDepartamento </b><br>";
	echo "<a href='welcomemanager.php'>VOLVER</a><br>";
}
	
?>