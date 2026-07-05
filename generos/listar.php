<?php

// ======================================================
// Arquivo: listar.php
// Lista todos os gêneros cadastrados
// ======================================================

include("../includes/verifica_login.php");
include("../conecta.php");
include("../includes/cabecalho.php");
include("../includes/menu.php");

// Consulta os gêneros
$sql = "SELECT * FROM generos ORDER BY genero";

$resultado = mysqli_query($conn, $sql);

// Quantidade de registros
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

    }

?>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="page-header">

            <div>

                <h1 class="page-title">
                    🎭 Gêneros
                </h1>
                <p class="page-subtitle">
                    Cadastre e organize os gêneros disponíveis para os filmes.
                </p>

            </div>

            <a href="cadastrar.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>
            Novo Gênero
            </a>

        </div>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <?php if($total > 0){ ?>

                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th width="80">ID</th>

                                <th>Gênero</th>

                                <th width="220">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php while($genero = mysqli_fetch_assoc($resultado)){ ?>

                            <tr>

                                <td><?= $genero["id"] ?></td>

                                <td><?= htmlspecialchars($genero["genero"]) ?></td>

                                <td>

                                    <a
                                        href="editar.php?id=<?= $genero["id"] ?>"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i> Editar

                                    </a>

                                    <a
                                        href="excluir.php?id=<?= $genero["id"] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Deseja realmente excluir este gênero?');">

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

                    Nenhum gênero cadastrado.

                </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php

include("../includes/rodape.php");

?>