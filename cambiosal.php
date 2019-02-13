<?php

	require('session.php');
	
	$idemp = $_SESSION['iduser']; //en este caso no se usa al ser el manager seleccionado el empleado no a el mismo
	$nuevoSalario = (int) $_POST['salario'];
	$empleado = $_POST['empleado'];
	
	/*obtenemos la fecha actual*/
	$selectFecha = "SELECT curdate();";
	$obtenerFecha = mysqli_query($conn, $selectFecha);	
	$fecha = mysqli_fetch_array($obtenerFecha);
	
/*Seleccionamos el ultimo salario*/  
$selectSalario = "SELECT salary, from_date FROM salaries WHERE emp_no = $empleado AND to_date = '9999-01-01';";	
$salario = mysqli_query($conn, $selectSalario);	
$viejoSalario = mysqli_fetch_array($salario);

if ($viejoSalario[0] == $nuevoSalario){ //comprobamos si tiene el mismo salario
	echo "tiene el mismo salario, espabila";
	mysqli_rollback($conn);
	die();
} else if($viejoSalario[1] == $fecha[0]){ //comprobamos si se ha cambiado ya hoy 
			echo "No se puede volver a cambier el salario hoy. Prueba ma&ntilde;ana.";
			mysqli_rollback($conn);
			die(); 
} else {

		/*Si todo es correcto, cambiamos el nuevo salario*/
		$sentenciaCambiarSal = mysqli_prepare($conn, "UPDATE salaries SET to_date = curdate() WHERE emp_no = ? AND from_date = '$viejoSalario[1]';");
		mysqli_stmt_bind_param($sentenciaCambiarSal, 'i', $empleado);
		mysqli_stmt_execute($sentenciaCambiarSal);

		/*Creamos un nuevo registro con el nuevo salario*/
		$sentenciaSalario = mysqli_prepare($conn, "INSERT INTO salaries (emp_no, salary, from_date, to_date) VALUES (?,?,curdate(),'9999-01-01');");
		mysqli_stmt_bind_param($sentenciaSalario, 'is', $empleado, $nuevoSalario);
		mysqli_stmt_execute($sentenciaSalario);
		
	echo "<p style='color: red;'>Se ha cambiado el nuevo salario correctamente.</p><br>";
	echo "El empleado: $empleado, ha pasado de:<b> $viejoSalario[0] </b>, al nuevo salario de: <b> $nuevoSalario </b><br>";
	echo "<a href='welcomemanager.php'>VOLVER</a><br>";
}
	
?>