<?php

// ======================================================
// Arquivo: cadastrar.php
// Cadastro de gêneros
// ======================================================

include("../includes/verifica_login.php");
include("../conecta.php");

// Variáveis
$genero = "";
$erro = "";

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $genero = trim($_POST["genero"]);

    // Validação
    if (empty($genero)) {

        $erro = "Informe o nome do gênero.";

    } else {

        // Verifica se já existe
        $sql = "SELECT id FROM generos WHERE genero = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $genero);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {

            $erro = "Este gênero já está cadastrado.";

        } else {

            // Insere
            $sql = "INSERT INTO generos (genero)
                    VALUES (?)";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt, "s", $genero);

            if (mysqli_stmt_execute($stmt)) {

                $_SESSION["mensagem"] = "Gênero cadastrado com sucesso!";

                header("Location: listar.php");

                exit();

            } else {

                $erro = "Erro ao cadastrar gênero.";

            }

        }

    }

}

include("../includes/cabecalho.php");
include("../includes/menu.php");

?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">

            <h3>Novo Gênero</h3>

        </div>

        <div class="card-body">

            <?php if (!empty($erro)) { ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($erro) ?>

                </div>

            <?php } ?>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">

                        Nome do gênero

                    </label>

                    <input
                        type="text"
                        name="genero"
                        class="form-control"
                        maxlength="50"
                        value="<?= htmlspecialchars($genero) ?>"
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Salvar

                </button>

                <a
                    href="listar.php"
                    class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>

<?php

include("../includes/rodape.php");

?>