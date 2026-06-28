<?php

include("../includes/verifica_login.php");
include("../conecta.php");

// Verifica o ID
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    $_SESSION["mensagem"] = "Gênero não encontrado.";

    header("Location: listar.php");
    exit();

}

$id = (int) $_GET["id"];

// Busca o gênero
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

$genero = mysqli_fetch_assoc($resultado);

// Se confirmou a exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se existem filmes utilizando este gênero
    $sql = "SELECT id
            FROM filmes
            WHERE id_genero = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {

        $_SESSION["mensagem"] = "Não é possível excluir este gênero, pois existem filmes vinculados a ele.";

        header("Location: listar.php");
        exit();

    }

    // Exclui
    $sql = "DELETE FROM generos WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION["mensagem"] = "Gênero excluído com sucesso.";

    } else {

        $_SESSION["mensagem"] = "Erro ao excluir o gênero.";

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

            <h3>Excluir Gênero</h3>

        </div>

        <div class="card-body">

            <p>

                Tem certeza que deseja excluir o gênero:

            </p>

            <h4>

                <?= htmlspecialchars($genero["genero"]) ?>

            </h4>

            <hr>

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