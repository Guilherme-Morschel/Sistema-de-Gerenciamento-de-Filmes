<?php

include("includes/verifica_login.php");
include("includes/cabecalho.php");
include("includes/menu.php");

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2>Bem-vindo ao Sistema de Gerenciamento de Filmes</h2>

            <hr>

            <p>

                Olá,

                <strong><?= htmlspecialchars($_SESSION["nome"]) ?></strong>

            </p>

            <p>

                Utilize o menu superior para acessar os módulos do sistema.

            </p>

        </div>

    </div>

</div>

<?php

include("includes/rodape.php");

?>