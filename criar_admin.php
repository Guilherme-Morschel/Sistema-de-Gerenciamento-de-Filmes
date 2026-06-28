<?php

// ======================================================
// Arquivo: criar_admin.php
// Cria o usuário administrador do sistema
// Executar apenas uma vez
// ======================================================

include("conecta.php");

// Dados do administrador
$nome = "Administrador";
$login = "admin";
$senha = password_hash("admin", PASSWORD_DEFAULT);

// Verifica se o usuário já existe
$sql = "SELECT id FROM usuarios WHERE login = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $login);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {

    echo "<h2>O usuário administrador já existe.</h2>";

} else {

    $sql = "INSERT INTO usuarios (nome, login, senha)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $nome, $login, $senha);

    if (mysqli_stmt_execute($stmt)) {

        echo "<h2>Usuário administrador criado com sucesso!</h2>";

        echo "<p><strong>Login:</strong> admin</p>";

        echo "<p><strong>Senha:</strong> admin</p>";

    } else {

        echo "<h2>Erro ao criar usuário.</h2>";

    }

}

mysqli_close($conn);

?>