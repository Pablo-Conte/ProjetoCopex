<?php 
    require '../config/connection.php';
    session_start();
    
    if(!isset($_SESSION['user_id'])){
        header("Location: /projetocopex/pages/login.php");
        die();

    }
?>

<h1>Welcome to the Admin Page, <?php echo($_SESSION['name']);?></h1>