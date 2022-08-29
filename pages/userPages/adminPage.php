<?php 
    require_once '../../includes/connection.php';
    session_start();

    if(!isset($_SESSION['user_id_admin'])){
        header("Location: ../projetocopex/pages/login.php");
        die();
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/headerHome.css">
    <script src="../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Home do administrador</title>
</head>
    <?php
        require_once './headerHome.php';
    ?>
    <div class="main">
        <h1>Welcome to the Admin Page</h1>
        <p>Nome do Admin: <?php echo($_SESSION['name']);?></p>
        <a href="./funcAdmin/register.php">Registrar ADM</a><br>
        <a href="./funcAdmin/registerEmpresa.php">Registrar EMPRESA</a><br>
        <a href="./funcAdmin/registerAluno.php">Registrar ALUNO</a><br></br>
    </div>
</body>
</html>
