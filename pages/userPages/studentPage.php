<?php 
    require_once '../../includes/connection.php';
    session_start();
    

    if(!isset($_SESSION['user_id_aluno'])){
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
    <h1>Welcome to the Student Page</h1>
    <p>Nome do Aluno: <?php echo($_SESSION['name']);?></p>
    <a href="../sair.php">Sair</a><br>

</body>
</html>