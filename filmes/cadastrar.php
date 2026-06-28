<?php

// ======================================================
// Arquivo: cadastrar.php
// Cadastro de filmes
// ======================================================

include("../includes/verifica_login.php");
include("../conecta.php");

// Busca os gêneros para preencher o SELECT
$sqlGeneros = "SELECT id, genero
               FROM generos
               ORDER BY genero";

$generos = mysqli_query($conn, $sqlGeneros);

// Variáveis
$titulo = "";
$diretor = "";
$id_genero = "";
$duracao = "";
$ano_lancamento = "";
$plataforma = "";

$erro = "";

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = preg_replace('/\s+/', ' ', trim($_POST["titulo"]));
    $diretor = preg_replace('/\s+/', ' ', trim($_POST["diretor"]));
    $id_genero = $_POST["id_genero"];
    $duracao = $_POST["duracao"];
    $ano_lancamento = $_POST["ano_lancamento"];
    $plataforma = $_POST["plataforma"] ?? "";

    // Validação
    // Validação
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
    $erro = "A duração deve ser um número maior que zero.";

    } elseif (!is_numeric($ano_lancamento)) {

        $erro = "Informe um ano válido.";

    } else {

        $anoAtual = date("Y");

        if ($ano_lancamento < 1900 || $ano_lancamento > $anoAtual) {

            $erro = "Ano de lançamento inválido.";

        } else {

            // INSERT ...

            $sql = "INSERT INTO filmes
                    (
                        titulo,
                        diretor,
                        id_genero,
                        duracao,
                        ano_lancamento,
                        plataforma
                    )
                    VALUES
                    (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "ssiiss",
                $titulo,
                $diretor,
                $id_genero,
                $duracao,
                $ano_lancamento,
                $plataforma
            );
            if (mysqli_stmt_execute($stmt)) {

                $_SESSION["mensagem"] = "Filme cadastrado com sucesso!";
                $_SESSION["tipo_mensagem"] = "success";

                header("Location: listar.php");
                exit();

            } else {

                $erro = "Erro ao cadastrar o filme.";

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

            <h3>Novo Filme</h3>

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

                        <option value="">Selecione um gênero</option>

                        <?php
                        mysqli_data_seek($generos, 0);

                        while ($g = mysqli_fetch_assoc($generos)) {
                        ?>

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