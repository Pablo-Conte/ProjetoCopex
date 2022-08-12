<?php
    require_once "./login/loginAuth.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
    <div>
        <h2>Login Admin</h2>
        <form action="login.php" method="POST">
            <input type="name" placeholder="Digite seu SIAPE" name="siape"></br>
            <input type="password" placeholder="Digite sua senha" name="password"></br></br>
            <button type="submit">Login</button>
            
            <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>

    <div>
        <h2>Login Estudante</h2>
        <form action="login.php" method="POST">
            <input type="text" placeholder="Digite sua matricula" name="matricula"></br>
            <input type="password" placeholder="Digite sua senha" name="password_aluno"></br></br>
            <button type="submit">Login</button>
            
            <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>

    <div>
        <h2>Login Empresa</h2>
        <form action="login.php" method="POST">
            <input type="name" placeholder="Digite seu CNPJ" name="cnpj"></br>
            <input type="password" placeholder="Digite sua senha" name="password_empresa"></br></br>
            <button type="submit">Login</button>
            
            <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>


</html>