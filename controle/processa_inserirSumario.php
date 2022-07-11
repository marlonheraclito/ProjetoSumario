<?php 
session_start();
include("conexao.php");


	$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
	$professor = filter_input(INPUT_POST, 'professor', FILTER_SANITIZE_NUMBER_INT);
	$disciplina = filter_input(INPUT_POST, 'nome_disciplina', FILTER_SANITIZE_NUMBER_INT);
	$curso = filter_input(INPUT_POST, 'nome_curso', FILTER_SANITIZE_NUMBER_INT);
	$aula = filter_input(INPUT_POST, 'aula', FILTER_SANITIZE_STRING);
	$conteudo = filter_input(INPUT_POST, 'conteudo', FILTER_SANITIZE_STRING);
	$turma = filter_input(INPUT_POST, 'turma', FILTER_SANITIZE_NUMBER_INT);

	$arquivos = $_FILES['arquivos'];

	$pasta = "../arquivos/";

	$nome = $arquivos['name']; 
	$novoNome = uniqid();
	$extensao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
	if($extensao != 'pdf') 
 	die("Ficheiro invalido");
	$path = $pasta . $novoNome . '.' . $extensao;

	$upload = move_uploaded_file($arquivos['tmp_name'], $path);

	if($upload){

		$res = "INSERT INTO sumario (conteudo, data, professor, disciplina, curso, aula, turma, path, nome_ficheiro) 
		VALUES ('$conteudo','$data', '$professor', '$disciplina', '$curso', '$aula', '$turma', '$path', '$nome')";
		$resultado = mysqli_query($conexao, $res); 

		if($resultado) {
			$_SESSION['msg'] = "Registrado";
			header('Location: ../visao/registrarSumario.php');
			exit();
		} else {
			$_SESSION['msg'] = "Erro... nao Registrado";
			header('Location: ../visao/registrarSumario.php');
			exit();
		}
	
	} else {
		echo "Erro ao enviar Arquivo!";
	}
 
	

	