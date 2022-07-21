<?php 
    require "../includes/connection.php";

    if()


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
    
    <form method="POST" action="register.php">

        <h1>Registro de Empresas</h1>

        <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ"><br>

        <input type="text" name="name" id="name" placeholder="Name"><br>

        <input type="email" name="email" id="email" placeholder="E-mail"><br>

        <input type="password" name="password" id="password" placeholder="Password"><br><br>

        <button type="submit">Cadastrar</button>

        <a href="./adminPage.php">AdminPage</a>

        <?php if(!empty($m)): ?>
            <p> <?= $m ?></p>
        <?php endif; ?>

    </form>

</body>
</html>