<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
	<title>Projeto Sumario</title>
</head>
<body class="body_login backgroud">

  <div id="div_login" class="box-shadow">


    <h3 class="center" style="margin-bottom:30px";>Sumarios Online</h3>
  

    <form id='form_login' action="controle/login.php" method="POST">
      <input type="text" name="email" placeholder="Email"></br>
      <input type="password" name="senha" placeholder="Password"></br>
      <input id="btnSubmit" type="submit" name="Enviar" value="Entrar">
    </form>
  
    <div id="msg">
       <p> <?php
           if(isset($_SESSION['msg']))
            echo $_SESSION['msg'];
             unset($_SESSION['msg']);
        ?></p>
    </div>
</div>

</body>
</html>