<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand fw-bold" href="/index.php">

            <span style="color:white;">🎬 Cine</span><span style="color:#E50914;">Manager</span>

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse"
            id="menu">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">

                    <a class="nav-link" href="/index.php">

                        <i class="bi bi-house-door-fill"></i>

                        Início

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="/filmes/listar.php">

                        <i class="bi bi-film"></i>

                        Filmes

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="/generos/listar.php">

                        <i class="bi bi-collection-play"></i>

                        Gêneros

                    </a>

                </li>

            </ul>

            <ul class="navbar-nav">

                <li class="nav-item">

                    <span class="nav-link">

                        <i class="bi bi-person-circle"></i>

                        <?= htmlspecialchars($_SESSION["usuario"]) ?>

                    </span>

                </li>

                <li class="nav-item">

                    <a class="nav-link text-danger" href="/logout.php">

                        <i class="bi bi-box-arrow-right"></i>

                        Sair

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>