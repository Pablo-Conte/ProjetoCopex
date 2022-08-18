<?php
    session_start();

    if(!isset($_SESSION['user_id_empresa'])){
        header("Location: /projetocopex/pages/login.php");
        die();
    }