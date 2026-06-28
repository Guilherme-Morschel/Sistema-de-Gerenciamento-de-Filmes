<?php

// ======================================================
// Arquivo: conecta.php
// Responsável pela conexão com o banco de dados MySQL
// ======================================================

// Dados da conexão
$servidor = "mysql";
$usuario = "aluno";
$senha = "aluno";
$banco = "sistema_filmes";

// Cria a conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se ocorreu erro na conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Define a codificação para UTF-8
mysqli_set_charset($conn, "utf8");

?>