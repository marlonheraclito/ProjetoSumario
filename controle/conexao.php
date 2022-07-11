<?php

// define('host', '127.0.0.1');
// define('user', 'root');
// define('senha', '');
// define('bd', 'bd_universidade');
$servername = "localhost";
$username = "root";
$password = "";
$basedados = "bd_universidade";


//$conexao = mysqli_connect(host, user, senha, bd) or die('sem conexao');

$conexao = new mysqli($servername, $username, $password, $basedados);

if($conexao->connect_error){
    die("Connection failed: " .$conexao->connect_error);
}

?>