<?php

session_start();
include("conexao.php");

$conteudo = filter_input(INPUT_POST, 'conteudo', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "update sumario set conteudo='$conteudo' where id='$id'";

$conn = mysqli_query($conexao, $query);

if($conn) {
    header('Location: ../visao/selecionarSumario.php');
} else {
    $_SESSION['msg'] = "não editado";
}

