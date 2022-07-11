<?php

session_start();

include('../controle/verifica.php');
include('../controle/conexao.php');
$tipo = $_SESSION['tipo'];

$consulta = "SELECT * FROM utilizador";
$con = mysqli_query($conexao, $consulta);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<title>Gerir user</title>
</head>
<body>
	<header>
		<h1 class="center" style="color:white";>UNIVERSIDADE</h1>
        <h2 class="center" style="color:white";>Sumário Online</h2>
    </header>

	<div class="menu-lateral box-shadow">
	<nav>
			<ul>
				  <li><a href="telaPrincipal.php">HOME</a></li>

				  <li <?php if($tipo == 'aluno') { ?>
				  style="display: none;" 

					<?php } ?>><a href="registrarSumario.php">Registrar Sumario</a></li>
				
				  <li <?php if($tipo == 'aluno' || $tipo == 'prof') { ?>
				  style="display: none;" 
					<?php } ?>><a href="selecionarSumario.php">Gestão Sumario</a></li>
				
					<li <?php if($tipo !== 'admin') { ?>
				style="display:none;"
				<?php } ?>><a href="gerirUser.php">Gestão Utilizador</a></li>

				<li><a href="../controle/logout.php">Sair</a></</li>
			</ul>
		</nav>
	</div>

	<main>
	<div id = "divMain" >
			</br>
		<h2 style="margin-bottom: 20px";>Insirir Utilizadores</h2>

		<form class="form-utilizador box-shadow" action="../controle/processa_inserirUtilizador.php", method="POST">
			<input type="text" name="user", id="user", placeholder="utilizador"></br>
			<input type="email" name="email", id="email", placeholder="email"></br>
			<input type="text" name="senha", id="senha", placeholder="senha"></br>

			<select name="tipo" id="tipo">
			<option>Tipo</option>
				<option>admin</option>
				<option>prof</option>
				<option>aluno</option>
			</select></br>
			<input class="btn" id="btnEnviar" type="submit" name="enviar", value="Enviar">
		</form>
					</br>
					</br>
 		 <?php
                if(isset($_SESSION['msg'])) 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            ?>
	
	
		<table class="box-shadow" style="margin-top:30px";>
				<tr>
					<th colspan="5">UTILIZADORES</th>
				</tr>
				<tr>
					<th>USER</th>
					<th>SENHA</th>
					<th>TIPO</th>
					<th>EMAIL</th>
					<th>GESTAO</th>
				</tr>
				<tr>
					<?php while ($dado = $con -> fetch_array()) { ?>
						<tr>
							<td><?php echo $dado['user']?></td>	
							<td><?php echo $dado['senha']?></td>	
							<td><?php echo $dado['tipo']?></td>
							<td><?php echo $dado['email']?></td>	
							<td><?php echo "<a class='botao1' href='editarUser.php?id=".$dado["id"]."'>Editar</a>";?>
							<?php echo "<a class='botao2' href='../controle/deletarUser.php?id=".$dado["id"]."'>Deletar</a>";?>
						</tr>
					<?php } ?>
				</tr>
			</table></br>	
	</div>
	</main>
	<footer>
		<p>Desenvolvedor Marlon Almeida</p>
	</footer>
</body>
</html>