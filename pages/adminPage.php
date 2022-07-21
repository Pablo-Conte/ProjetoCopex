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
    <h1>Welcome to the Admin Page, <?php echo($_SESSION['name']);?></h1>
    <a href="./register.php">Registrar</a>
    <a href="./sair.php">Sair</a>
</body>
</html>
