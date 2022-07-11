<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');


include('../controle/verifica.php');
include('../controle/conexao.php');

$consulta = "SELECT s.id, s.conteudo, s.data, p.nomeProf, d.nome, c.nomeCurso, s.aula, t.nomeTurma FROM 
sumario s, disciplina d, professor p, curso c, turma t WHERE s.disciplina = d.id AND s.professor = p.id 
AND s.curso = c.id AND s.turma = t.id";

$con = mysqli_query($conexao, $consulta);

$tipo = $_SESSION['tipo'];

?>

<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<title>Selecionar Sumario</title>
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
	<div id = "divMain">
					</br><h2>Gestão Sumarios</h2>
					</br></br>
		<table class="box-shadow">
				<tr>
					<th class="cor" colspan="8">SUMARIOS</th>
				</tr>
				<tr>
					<th>CONTEUDO</th>
					<th>DATA</th>
					<th>PROFESSOR</th>
					<th>DISCIPLINA</th>
					<th>CURSO</th>
					<th>TURMA</th>
					<th>AULA</th>
					<th>GESTÃO</th>
				</tr>
				<tr>
					<?php while ($dado = $con -> fetch_array()) { ?>
						<tr>	
							<td><?php echo $dado['conteudo']?></td>	
							<td><?php echo $dado['data']?></td>
							<td><?php echo $dado['nomeProf']?></td>
							<td><?php echo utf8_encode($dado['nome'])?></td>
							<td><?php echo $dado['nomeCurso']?></td>
							<td><?php echo $dado['nomeTurma']?></td>
							<td><?php echo $dado['aula']?></td>
							<td><?php echo "<a class='botao1' href='editarSumario.php?id=".$dado["id"]."'>Editar</a>";?><?php echo "<a class='botao2' href='../controle/deletarSumario.php?id=".$dado["id"]."'>Deletar</a>";?>
					</td>
						</tr>
					<?php } ?>
				</tr>
			</table>
		</div>
	</main>
	<footer>
		<p>Desenvolvedor Marlon Almeida</p>
	</footer>			
</body>
</html>