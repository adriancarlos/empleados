<HTML>
<HEAD> <TITLE>Adrian&Carlos calculadora</TITLE>
</HEAD>
<BODY>
<form name='mi_formulario' action='cambiodpto.php' method='post'>

 <h1> Cambio Departamento</h1><br>
 
 Seleccione el nuevo Departamento: <select name="departamento">
	<?php
	include('session.php');

	$sql = "SELECT DISTINCT dept_name FROM departments";
	$resultado = mysqli_query($conn,$sql);
	while($fila = mysqli_fetch_assoc($resultado)){
		echo "<option value='".$fila['dept_name']."'>".$fila['dept_name']."</option>";
	}
	?>
</select><br>

Selecciona el empleado: <select name="empleado">
	<?php
	include('session.php');

	$sql = "SELECT emp_no FROM employees LIMIT 200";
	$resultado = mysqli_query($conn,$sql);
	while($fila = mysqli_fetch_assoc($resultado)){
		echo "<option value='".$fila['emp_no']."'>".$fila['emp_no']."</option>";
	}
	?>
</select>
<input type="submit" value="Cambiar"><br>

<a href="welcomemanager.php">VOLVER</a><br>




</FORM>
</BODY>
</HTML>