<?php

	require('session.php');
	
	$idemp = $_SESSION['iduser']; //en este caso no se usa al ser el manager seleccionado el empleado no a el mismo
	$nuevaCategoria = $_POST['categoria'];
	$empleado = $_POST['empleado'];

	
/*Seleccionamos el nombre de la vieja Categoria*/  
$selectCat = "SELECT title, from_date, to_date FROM titles WHERE emp_no = $empleado AND to_date = '9999-01-01';";	
$categoria = mysqli_query($conn, $selectCat);	
$viejaCat = mysqli_fetch_array($categoria);

/*select para que seleccione si dicho empleado ha estado ya en esa categoria*/
$selectCategorias = "SELECT count(*) as titulo FROM titles WHERE emp_no = $empleado AND title = '$nuevaCategoria';";	
$categorias = mysqli_query($conn, $selectCategorias);	
$viejaCategorias = mysqli_fetch_array($categorias);


if ($viejaCat[0] == $nuevaCategoria){ //comprobamos si esta en la misma Categoria
	echo "Ya esta en ese departamento, espabila";
	mysqli_rollback($conn);
	die();
} else if($viejaCategorias[0] == 1){ //comprobamos si ya ha estado en esa categoria
			echo "No se puede volver a mover a ese empleado a $nuevaCategoria porque ya ha estado.";
			mysqli_rollback($conn);
			die(); 
} else {

		/*Si todo es correcto, cambiamos la nueva categoria*/
		$sentenciaCambiarCat = mysqli_prepare($conn, "UPDATE titles SET to_date = curdate() WHERE emp_no = ?;");
		mysqli_stmt_bind_param($sentenciaCambiarCat, 'i', $empleado);
		mysqli_stmt_execute($sentenciaCambiarCat);

		/*Creamos un nuevo registro con la nueva Categoria*/
		$sentenciaCategoria = mysqli_prepare($conn, "INSERT INTO titles (emp_no, title, from_date, to_date) VALUES (?,?,curdate(),'9999-01-01');");
		mysqli_stmt_bind_param($sentenciaCategoria, 'is', $empleado, $nuevaCategoria);
		mysqli_stmt_execute($sentenciaCategoria);
		
	echo "<p style='color: red;'>Se ha cambiado la nueva categoria correctamente.</p><br>";
	echo "Ha pasado de:<b> $viejaCat[0] </b>, a la nueva categoria de: <b> $nuevaCategoria </b><br>";
	echo "<a href='welcomemanager.php'>VOLVER</a><br>";
}
	
?>