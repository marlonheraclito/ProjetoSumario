<?php
session_start();
include('../controle/verifica.php');
include('../controle/conexao.php');

$tipo = $_SESSION['tipo'];
$id_curso = null;
$id_turma = null;
if($tipo == 'aluno') {
$nomeAluno = $_SESSION['user'];
$consulta_aluno = "SELECT * FROM aluno where nome = '$nomeAluno'";

$res = mysqli_query($conexao, $consulta_aluno);
$dadosAluno = $res -> fetch_array();

$id_curso = $dadosAluno['curso'];
$id_turma = $dadosAluno['turma'];	

} 

$id_disciplina = filter_input(INPUT_GET, 'disciplina', FILTER_SANITIZE_NUMBER_INT);

$consulta = "SELECT s.conteudo, s.aula, s.data, d.nome, s.path, s.nome_ficheiro from sumario s, disciplina d WHERE 
s.disciplina = '$id_disciplina' AND s.curso = '$id_curso' AND s.turma = '$id_turma' 
AND s.disciplina = d.id";

$con = mysqli_query($conexao, $consulta);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" type="text/css" href="../css/estilo.css">
	  <link rel="stylesheet" type="text/css" href="../css/estiloMedia.css">
	<title>Tela Principal</title>
</head>

<body>
<header>
		<h1 class="center" style="color: white";>UNIVERSIDADE</h1>
		<h2 class="center" style="color: white";>Sumario Online</h2></br>
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
		</br>
		<h2>Bem-vindo</h2></br>
	

		<p><?php 
				$query = "SELECT * FROM turma where id = $id_turma";
				$num = mysqli_query($conexao, $query);
				
				if($num) {		
					$n = $num -> fetch_array();
					echo "Turma ", $n['nomeTurma'];
				} else {
					echo "";
				}	
				?>		
		</p>
		

		<p><?php 
			$query = "SELECT * FROM curso where id = $id_curso";
			$num = mysqli_query($conexao, $query);
			if($num) {
			$n = $num -> fetch_array();
			echo "Curso ", $n['nomeCurso'];
			} else {
				echo "";
			}	
			?>	
		</p><br>

		
		
	<form action="telaPrincipal.php" method="GET">
		<select id="pesquisarSumario" name='disciplina' id="disciplina">
			<option>Disciplina</option>
				<?php 
					$query = "SELECT * FROM disciplina WHERE curso = $id_curso";
					$num = mysqli_query($conexao, $query);
					if($num){
					while ($n = $num -> fetch_array()) { ?>
						<option value=<?php echo $n['id'];?>>
							<?php echo utf8_encode($n['nome']); ?>
						</option>
				<?php }} else {
					echo "";
				} ?>
		</select>
		<input class="btn" type="submit" name="Pesquisa" value="Pesquisa">
	</form>
	</br>

			<table class="box-shadow">
				<tr>
					<th class="cor" colspan="5">SUMARIOS</th>
				</tr>
				<tr>
					<th>DISCIPLINA</th>
					<th>CONTEUDO</th>
					<th>AULA</th>
					<th>DATA</th>
					<th>FICHEIRO</th>
				</tr>
				<tr>
					<?php while ($dado = $con -> fetch_array()) { ?>
						<tr>
							<td><?php echo utf8_encode($dado['nome'])?></td>
							<td><?php echo $dado['conteudo']?></td>		
							<td><?php echo $dado['aula']?></td>	
							<td><?php echo $dado['data']?></td>
							<td><a class='botao1' target="_black" href="<?php echo $dado['path']?>"><?php echo $dado['nome_ficheiro']?></a></td>
						</tr>
					<?php } ?>
				</tr>
			</table>
		
	</main>


	<footer>
		<p>Desenvolvedor Marlon Almeida</p>
	</footer>
</body>

</html>