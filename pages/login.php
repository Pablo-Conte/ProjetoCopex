<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <h1>Hellow World Caralho</h1>
    <div>
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" placeholder="Digite seu email" name="email">
            <input type="password" placeholder="Digite seu email" name="password">
            <button type="submit">Login</button>
        </form>
    </div>
</body>
<?php 
    require_once '../config/connection.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $query = "SELECT siape_administrador, senha_administrador FROM site WHERE siape_administrador = :email AND senha_administrador = :password";
        $result = mysqli_query($conn, $query);
        echo($result);
    }
    
    




?>

</html>