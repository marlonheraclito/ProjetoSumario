<?php 
session_start();

include('../controle/verifica.php');
include('../controle/conexao.php');

$tipo = $_SESSION['tipo'];

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

//$consulta = "Select * from sumario where id='$id'";

$consulta = "SELECT s.id, s.conteudo, s.data, p.nomeProf, d.nome, c.nomeCurso, s.aula, t.nomeTurma FROM 
sumario s, disciplina d, professor p, curso c, turma t WHERE s.disciplina = d.id AND s.professor = p.id 
AND s.curso = c.id AND s.turma = t.id AND s.id='$id'";

$conn = mysqli_query($conexao, $consulta);
$dado = mysqli_fetch_assoc($conn);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<title>Editar Sumario</title>
</head>
<body>

<header>
</header>
	
	
<div class="menu-lateral">

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
	<div id = "divMain">

		<h1>UNIVERSIDADE</h1>
		<h2>Editar de Sumario</h2></br>
		<p><?php echo 'Utilizador ', $_SESSION['user'], " Tipo: ",$tipo; ?></p></br></br>

		
	
	<form class="form-editarSumario" action="../controle/processa_editarSumario.php" method="POST">

		<input type="text" style="display: none;"  readonly name="id" value="<?php echo $dado['id']; ?>">

		<label><?php echo "Data ".$dado['data'];?></label></br>	  
		<label><?php echo "Professor ".$dado['nomeProf']; ?></label></br>
		<label><?php echo "Disciplina ".$dado['nome']; ?></label></br> 
		<label><?php echo "Curso ".$dado['nomeCurso']; ?></label></br>
		<label><?php echo $dado['aula']; ?></label></br></br>

	
 		<input id="inputSumario" type="text" name="conteudo" placeholder="conteudo" value="<?php echo $dado['conteudo']?>">
 		<input type="submit" name="enviar" value="Editar">
		</form>

		<?php
                if(isset($_SESSION['msg'])) 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            ?>

	</div>
	</main>
	<footer>
		<p>Desenvolvedor Marlon Almeida</p>
	</footer>			
</body>
</html>