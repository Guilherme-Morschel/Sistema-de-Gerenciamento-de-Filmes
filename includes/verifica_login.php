<?php

// ======================================================
// Arquivo: verifica_login.php
// Verifica se o usuário está autenticado
// ======================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {

    header("Location: /login.php");
    exit();

}