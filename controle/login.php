<?php
session_start();
require('conexao.php');

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

if(empty($email) || empty($senha)) {
	$_SESSION['msg'] = "Campos Vazios";
	header('Location: ../index.php');
	exit();
}

if(empty($email)) {
	$_SESSION['msg'] = "Email nao pode ser vazio";
	header('Location: ../index.php');
	exit();
}

if(empty($senha)) {
	$_SESSION['msg'] = "Senha nao pode ser vazio";
	header('Location: ../index.php');
	exit();
}


$query = "select * from utilizador where email = '{$email}' and senha ='{$senha}'";

$conecta = mysqli_query($conexao, $query);

$utilizador = $conecta -> fetch_array();

$row = mysqli_num_rows($conecta);


// responsavel por responder a requizicao a base dados e tomar acao 
if($row == 1){
	$_SESSION['email'] = $utilizador['email'];
	$_SESSION['user'] = $utilizador['user'];
	$_SESSION['id'] = $utilizador['id'];
	$_SESSION['tipo'] = $utilizador['tipo'];

	header('Location: ../visao/telaPrincipal.php');
	exit();
} else {
	$_SESSION['msg'] = "Email ou senha Invalido";
	header('Location: ../index.php');
	exit();
}


