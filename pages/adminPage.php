<?php 
    require '../includes/connection.php';
    session_start();
    

    if(!isset($_SESSION['user_id'])){
        header("Location: /projetocopex/pages/login.php");
        die();
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to the Admin Page</h1>
    <p>Nome do Admin: <?php echo($_SESSION['name']);?></p>
    <a href="./register.php">Registrar ADM</a><br>
    <a href="./registerEmpresa.php">Registrar EMPRESA</a><br>
    <a href="./registerAluno.php">Registrar ALUNO</a><br>
    <a href="./sair.php">Sair</a><br>
    <?php
        var_dump($_SESSION);
    ?>
</body>
</html>
