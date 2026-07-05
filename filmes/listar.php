<?php

// ======================================================
// Arquivo: listar.php
// Lista todos os filmes cadastrados
// ======================================================

include("../includes/verifica_login.php");
include("../conecta.php");
include("../includes/cabecalho.php");
include("../includes/menu.php");

// Busca os filmes juntamente com o nome do gênero
$sql = "SELECT
            filmes.id,
            filmes.titulo,
            filmes.diretor,
            generos.genero,
            filmes.duracao,
            filmes.ano_lancamento,
            filmes.plataforma
        FROM filmes
        INNER JOIN generos
            ON filmes.id_genero = generos.id
        ORDER BY filmes.titulo";

$resultado = mysqli_query($conn, $sql);

$total = mysqli_num_rows($resultado);

?>

<div class="container mt-4">

    <?php if (isset($_SESSION["mensagem"])) { ?>

        <div class="alert alert-<?= $_SESSION["tipo_mensagem"] ?? "success" ?> alert-dismissible fade show">

            <?= htmlspecialchars($_SESSION["mensagem"]) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php

    unset($_SESSION["mensagem"]);
    unset($_SESSION["tipo_mensagem"]);

    } ?>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="page-header">

            <div>

                <h1 class="page-title">
                🎥 Filmes
                </h1>

                <p class="page-subtitle">
                Gerencie todos os filmes cadastrados no sistema.
                </p>

            </div>

            <a href="cadastrar.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>
                Novo Filme
            </a>

        </div>
    </div>


    <div class="card shadow">

        <div class="card-body">

            <?php if ($total > 0) { ?>

                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>
                                <th>Título</th>
                                <th>Diretor</th>
                                <th>Gênero</th>
                                <th>Duração</th>
                                <th>Ano</th>
                                <th>Plataforma</th>
                                <th width="180">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php while ($filme = mysqli_fetch_assoc($resultado)) { ?>

                            <tr>

                                <td><?= $filme["id"] ?></td>

                                <td><?= htmlspecialchars($filme["titulo"]) ?></td>

                                <td><?= htmlspecialchars($filme["diretor"]) ?></td>

                                <td><?= htmlspecialchars($filme["genero"]) ?></td>

                                <td><?= $filme["duracao"] ?> min</td>

                                <td><?= $filme["ano_lancamento"] ?></td>

                                <td><?= htmlspecialchars($filme["plataforma"]) ?></td>

                                <td>

                                    <a
                                        href="editar.php?id=<?= $filme["id"] ?>"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i> Editar

                                    </a>

                                    <a
                                        href="excluir.php?id=<?= $filme["id"] ?>"
                                        class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash3-fill"></i> Excluir

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } else { ?>

                <div class="alert alert-info">

                    Nenhum filme cadastrado.

                </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php

include("../includes/rodape.php");

?>