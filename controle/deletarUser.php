<?php 
session_start();
include('conexao.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "DELETE FROM utilizador WHERE id='$id'";

$resultado = mysqli_query($conexao, $query);


if($resultado) {
	header('Location: ../visao/gerirUser.php');
	exit();
}


?>