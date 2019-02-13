<HTML>
<HEAD> <TITLE>Adrian&Carlos calculadora</TITLE>
</HEAD>
<BODY>
<form name='mi_formulario' action='consultasalmanager.php' method='post'>

 <h1> Consulta Departamento</h1><br>

Selecciona el empleado que quieres consultar el Salario: <select name="empleado">
	<?php
	include('session.php');

	$sql = "SELECT emp_no FROM employees LIMIT 200";
	$resultado = mysqli_query($conn,$sql);
	while($fila = mysqli_fetch_assoc($resultado)){
		echo "<option value='".$fila['emp_no']."'>".$fila['emp_no']."</option>";
	}
	?>
</select>
<input type="submit" value="Consultar"><br>

<a href="welcomemanager.php">VOLVER</a><br>




</FORM>
</BODY>
</HTML>