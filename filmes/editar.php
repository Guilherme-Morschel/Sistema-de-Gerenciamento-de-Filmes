<?php

// ======================================================
// Arquivo: editar.php
// Edição de filmes
// ======================================================

include("../includes/verifica_login.php");
include("../conecta.php");

// Verifica o ID
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    $_SESSION["mensagem"] = "Filme não encontrado.";
    $_SESSION["tipo_mensagem"] = "danger";

    header("Location: listar.php");
    exit();
}

$id = (int) $_GET["id"];

// Busca o filme
$sql = "SELECT * FROM filmes WHERE id = ?";

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

// Busca os gêneros
$sqlGeneros = "SELECT id, genero
               FROM generos
               ORDER BY genero";

$generos = mysqli_query($conn, $sqlGeneros);

// Preenche variáveis
$titulo = $filme["titulo"];
$diretor = $filme["diretor"];
$id_genero = $filme["id_genero"];
$duracao = $filme["duracao"];
$ano_lancamento = $filme["ano_lancamento"];
$plataforma = $filme["plataforma"];

$erro = "";

// Atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = preg_replace('/\s+/', ' ', trim($_POST["titulo"]));
    $diretor = preg_replace('/\s+/', ' ', trim($_POST["diretor"]));
    $id_genero = $_POST["id_genero"];
    $duracao = $_POST["duracao"];
    $ano_lancamento = $_POST["ano_lancamento"];
    $plataforma = $_POST["plataforma"] ?? "";

    if (
        empty($titulo) ||
        empty($diretor) ||
        empty($id_genero) ||
        empty($duracao) ||
        empty($ano_lancamento) ||
        empty($plataforma)
    ) {

        $erro = "Preencha todos os campos.";

    } elseif (strlen($titulo) < 2) {

        $erro = "O título deve possuir pelo menos 2 caracteres.";

    } elseif (strlen($diretor) < 2) {

        $erro = "Informe um diretor válido.";

    } elseif (!is_numeric($duracao) || $duracao <= 0) {

        $erro = "A duração deve ser maior que zero.";

    } elseif (!is_numeric($ano_lancamento)) {

        $erro = "Informe um ano válido.";

    } else {

        $anoAtual = date("Y");

        if ($ano_lancamento < 1900 || $ano_lancamento > $anoAtual) {

            $erro = "Ano de lançamento inválido.";

        } else {

            $sql = "UPDATE filmes
                    SET
                        titulo = ?,
                        diretor = ?,
                        id_genero = ?,
                        duracao = ?,
                        ano_lancamento = ?,
                        plataforma = ?
                    WHERE id = ?";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "ssiissi",
                $titulo,
                $diretor,
                $id_genero,
                $duracao,
                $ano_lancamento,
                $plataforma,
                $id
            );

            if (mysqli_stmt_execute($stmt)) {

                $_SESSION["mensagem"] = "Filme atualizado com sucesso!";
                $_SESSION["tipo_mensagem"] = "success";

                header("Location: listar.php");
                exit();

            } else {

                $erro = "Erro ao atualizar o filme.";

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

            <h3>Editar Filme</h3>

        </div>

        <div class="card-body">

            <?php if (!empty($erro)) { ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($erro) ?>

                </div>

            <?php } ?>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">Título</label>

                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        maxlength="100"
                        value="<?= htmlspecialchars($titulo) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">Diretor</label>

                    <input
                        type="text"
                        name="diretor"
                        class="form-control"
                        maxlength="100"
                        value="<?= htmlspecialchars($diretor) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">Gênero</label>

                    <select
                        name="id_genero"
                        class="form-select">

                        <?php while($g = mysqli_fetch_assoc($generos)){ ?>

                            <option
                                value="<?= $g["id"] ?>"
                                <?= ($id_genero == $g["id"]) ? "selected" : "" ?>>

                                <?= htmlspecialchars($g["genero"]) ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Duração (minutos)

                    </label>

                    <input
                        type="number"
                        name="duracao"
                        class="form-control"
                        min="1"
                        value="<?= htmlspecialchars($duracao) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Ano de lançamento

                    </label>

                    <input
                        type="number"
                        name="ano_lancamento"
                        class="form-control"
                        min="1900"
                        max="<?= date("Y") ?>"
                        value="<?= htmlspecialchars($ano_lancamento) ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label d-block">

                        Plataforma

                    </label>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="plataforma"
                            value="streaming"
                            <?= ($plataforma == "streaming") ? "checked" : "" ?>>

                        <label class="form-check-label">

                            Streaming

                        </label>

                    </div>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="plataforma"
                            value="cinema"
                            <?= ($plataforma == "cinema") ? "checked" : "" ?>>

                        <label class="form-check-label">

                            Cinema

                        </label>

                    </div>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="plataforma"
                            value="ambos"
                            <?= ($plataforma == "ambos") ? "checked" : "" ?>>

                        <label class="form-check-label">

                            Cinema + Streaming

                        </label>

                    </div>

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