<?php

session_start();
include("conexao.php");

$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);


$res = "INSERT INTO utilizador (user, senha, tipo, email) VALUES ('$user', '$senha', '$tipo', '$email')";


$resultado = mysqli_query($conexao, $res);

if($resultado) {
	$_SESSION['msg'] = "Registrado";
	header('Location: ../visao/gerirUser.php');
	exit(); 
} else {
	$_SESSION['msg'] = "Erro... nao Registrado";
	header('Location: ../visao/gerirUser.php');
	exit();
}