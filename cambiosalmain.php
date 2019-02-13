<HTML>
<HEAD> <TITLE>Adrian&Carlos calculadora</TITLE>
</HEAD>
<BODY>
<form name='mi_formulario' action='cambiosal.php' method='post'>

 <h1> Cambio Salario</h1><br>

Selecciona el empleado: <select name="empleado">
	<?php
	include('session.php');

	$sql = "SELECT emp_no FROM employees LIMIT 200";
	$resultado = mysqli_query($conn,$sql);
	while($fila = mysqli_fetch_assoc($resultado)){
		echo "<option value='".$fila['emp_no']."'>".$fila['emp_no']."</option>";
	}
	?>
</select><br>

Nuevo Salario: <input type="number" name="salario">

 <input type="submit" value="Cambiar"><br>

<a href="welcomemanager.php">VOLVER</a><br>




</FORM>
</BODY>
</HTML>