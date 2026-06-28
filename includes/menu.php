<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="/index.php">

            🎬 Sistema de Filmes

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a class="nav-link" href="/index.php">

                        Início

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="/filmes/listar.php">

                        Filmes

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="/generos/listar.php">

                        Gêneros

                    </a>

                </li>

            </ul>

            <span class="navbar-text me-3">

                <?= htmlspecialchars($_SESSION["nome"]) ?>

            </span>

            <a
                href="/logout.php"
                class="btn btn-outline-light">

                Sair

            </a>

        </div>

    </div>

</nav>