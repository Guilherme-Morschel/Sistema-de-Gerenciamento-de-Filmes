<?php

include("../includes/verifica_login.php");
include("../conecta.php");

// Verifica se o ID foi informado
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    $_SESSION["mensagem"] = "Gênero não encontrado.";
    

    header("Location: listar.php");
    exit();

}

$id = (int) $_GET["id"];

$sql = "SELECT * FROM generos WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 0) {

    $_SESSION["mensagem"] = "Gênero não encontrado.";

    header("Location: listar.php");
    exit();

}

$dados = mysqli_fetch_assoc($resultado);

$genero = $dados["genero"];

$erro = "";

// Atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $genero = trim($_POST["genero"]);

    if (empty($genero)) {

        $erro = "Informe o nome do gênero.";

    } else {

        // Verifica duplicidade (exceto o próprio registro)
        $sql = "SELECT id
                FROM generos
                WHERE genero = ?
                AND id <> ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "si", $genero, $id);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {

            $erro = "Já existe um gênero com este nome.";

        } else {

            $sql = "UPDATE generos
                    SET genero = ?
                    WHERE id = ?";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt, "si", $genero, $id);

            if (mysqli_stmt_execute($stmt)) {

                $_SESSION["mensagem"] = "Gênero atualizado com sucesso.";

                header("Location: listar.php");
                exit();

            } else {

                $erro = "Erro ao atualizar o gênero.";

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

            <h3>Editar Gênero</h3>

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
                    class="btn btn-primary">

                    Atualizar

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