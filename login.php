<?php

// ======================================================
// Arquivo: login.php
// Tela de autenticação do sistema
// ======================================================

session_start();

include("conecta.php");

// Se o usuário já estiver logado
if (isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

// Variáveis
$login = "";
$erro = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados
    $login = trim($_POST["login"]);
    $senha = trim($_POST["senha"]);

    // Validação
    if (empty($login) || empty($senha)) {

        $erro = "Preencha todos os campos.";

    } else {

        // Consulta o usuário
        $sql = "SELECT id, nome, login, senha
                FROM usuarios
                WHERE login = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $login);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        // Encontrou usuário?
        if (mysqli_num_rows($resultado) == 1) {

            $usuario = mysqli_fetch_assoc($resultado);

            // Verifica a senha
            if (password_verify($senha, $usuario["senha"])) {

                $_SESSION["usuario"] = $usuario["login"];
                $_SESSION["nome"] = $usuario["nome"];

                header("Location: index.php");
                exit();

            } else {

                $erro = "Usuário ou senha inválidos.";

            }

        } else {

            $erro = "Usuário ou senha inválidos.";

        }

    }

}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Sistema de Gerenciamento de Filmes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">

                    <h3>Sistema de Gerenciamento de Filmes</h3>

                </div>

                <div class="card-body">

                    <?php if (!empty($erro)) { ?>

                        <div class="alert alert-danger">

                            <?php echo $erro; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Usuário

                            </label>

                            <input
                                type="text"
                                name="login"
                                class="form-control"
                                value="<?php echo htmlspecialchars($login); ?>"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Senha

                            </label>

                            <input
                                type="password"
                                name="senha"
                                class="form-control"
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Entrar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>