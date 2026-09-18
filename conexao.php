<?php
$host = "localhost";
$dbname = "sistema_escolar";
$usuario = "root";
$senha = "";

$conn = new mysqli($host, $usuario, $senha, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
session_start();
?>