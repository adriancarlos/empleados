<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Bienvenido <?php echo $login_session; ?></h1> 
	  
	  
	  <nav class="dropdownmenu">
  <ul>
	<li><a href="cambiodptomain.php">Cambiar Departamento</a></li>
    
    <li><a href="cambiosalmain.php">Cambiar Salario</a></li>
	
	<li><a href="cambiocatmain.php">Cambiar Categoria</a></li>
	
    <li><a href="consultadptomainmanager.php">Consultar Departamento</a></li>
    
    <li><a href="consultasalmainmanager.php">Consultar Salario</a></li>
	
	<li><a href="consultacatmainmanager.php">Consultar Categoria</a></li>
  
  </ul>
</nav>
	  
	  
	  
      <h2><a href = "logout.php">Cerrar Sesion</a></h2>
   </body>
   
</html>