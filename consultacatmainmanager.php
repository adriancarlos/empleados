<HTML>
<HEAD> <TITLE>Adrian&Carlos calculadora</TITLE>
</HEAD>
<BODY>
<form name='mi_formulario' action='consultacatmanager.php' method='post'>

 <h1> Consulta Departamento</h1><br>

Selecciona el empleado que quieres consultar la Categoria: <select name="empleado">
	<?php
	 require('../models/modelousuario.php');
	?>
</select>
<input type="submit" value="Consultar"><br>

<a href="welcomemanager.php">VOLVER</a><br>




</FORM>
</BODY>
</HTML>