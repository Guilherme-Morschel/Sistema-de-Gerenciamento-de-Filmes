<?php

// ======================================================
// Arquivo: excluir.php
// Exclusão de filmes
// ======================================================

include("../includes/verifica_login.php");
include("../conecta.php");

// Verifica se o ID foi informado
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    $_SESSION["mensagem"] = "Filme não encontrado.";
    $_SESSION["tipo_mensagem"] = "danger";

    header("Location: listar.php");
    exit();
}

$id = (int) $_GET["id"];

// Busca o filme juntamente com o nome do gênero
$sql = "SELECT
            filmes.id,
            filmes.titulo,
            filmes.diretor,
            filmes.ano_lancamento,
            generos.genero
        FROM filmes
        INNER JOIN generos
            ON filmes.id_genero = generos.id
        WHERE filmes.id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 0) {

    $_SESSION["mensagem"] = "Filme não encontrado.";
    $_SESSION["tipo_mensagem"] = "danger";

    header("Location: listar.php");
    exit();
}

$filme = mysqli_fetch_assoc($resultado);

// Confirma exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM filmes WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION["mensagem"] = "Filme excluído com sucesso.";
        $_SESSION["tipo_mensagem"] = "success";

    } else {

        $_SESSION["mensagem"] = "Erro ao excluir o filme.";
        $_SESSION["tipo_mensagem"] = "danger";

    }

    header("Location: listar.php");
    exit();
}

include("../includes/cabecalho.php");
include("../includes/menu.php");

?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-danger text-white">

            <h3>Excluir Filme</h3>

        </div>

        <div class="card-body">

            <p class="mb-3">

                Tem certeza que deseja excluir o seguinte filme?

            </p>

            <table class="table table-bordered">

                <tr>

                    <th width="180">Título</th>

                    <td><?= htmlspecialchars($filme["titulo"]) ?></td>

                </tr>

                <tr>

                    <th>Diretor</th>

                    <td><?= htmlspecialchars($filme["diretor"]) ?></td>

                </tr>

                <tr>

                    <th>Gênero</th>

                    <td><?= htmlspecialchars($filme["genero"]) ?></td>

                </tr>

                <tr>

                    <th>Ano</th>

                    <td><?= $filme["ano_lancamento"] ?></td>

                </tr>

            </table>

            <form method="POST">

                <button
                    type="submit"
                    class="btn btn-danger">

                    Excluir

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