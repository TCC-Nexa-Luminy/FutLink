<?php
define("SERVER", 'localhost');
define("USUARIO", 'root');
define("SENHA", '');
define("DATABASE", 'db_futlink');

$conn = mysqli_connect(SERVER, USUARIO, SENHA, DATABASE);

mysqli_query($conn, "SET NAMES utf8");

if($conn->connect_error){
    die("Falha na conexão" . $conn->connect_error);
}else{
    echo "Conectado ao banco de dados";
}