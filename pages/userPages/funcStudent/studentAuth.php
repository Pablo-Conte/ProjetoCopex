<?php
    session_start();

    if(!isset($_SESSION['user_id_aluno'])){
        header("Location: /projetocopex/pages/login.php");
        die();
    }