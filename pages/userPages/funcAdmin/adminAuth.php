<?php
    session_start();

    if(!isset($_SESSION['user_id_admin'])){
        header("Location: /projetocopex/pages/login.php");
        die();
    }