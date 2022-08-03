<?php 
    require "../includes/connection.php";

    if(!empty($_POST['cnpj']) && !empty($_POST['password'] && !empty($_POST['name']) && !empty($_POST['email']))){
        if ($_POST['password'] == $_POST['passwordVerify']){
            
            $cnpj = $_POST['cnpj'];
            $email = $_POST['email'];
            $nome = $_POST['name'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = $conn->prepare("SELECT * FROM empresa WHERE cnpj = :cnpj OR email = :email");
            $query->bindParam(':cnpj', $cnpj);
            $query->bindParam(':email', $email);
            $query->execute();

            $results = $query->fetch(PDO::FETCH_ASSOC);

            if($results == 0){
                $query = $conn->prepare("INSERT INTO empresa (
                    nome,     
                    senha,     
                    cnpj,     
                    email
                ) VALUES (  
                    :nome,     
                    :senha,     
                    :cnpj,     
                    :email
                )");

                $query->bindParam(':nome', $nome);
                $query->bindParam(':senha', $password);
                $query->bindParam(':cnpj', $cnpj);
                $query->bindParam(':email', $email);

                $query->execute();

                $m = "<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!')</script>";

            } else {
                $m = 'Usuário já cadastrado';
            }
            
        } else {
            $m = 'Senhas não iguais, verifique!';
        }

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
    
    <form method="POST" action="registerEmpresa.php">

        <h1>Registro de Empresas</h1>

        <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ"><br>

        <input type="text" name="name" id="name" placeholder="Name"><br>

        <input type="email" name="email" id="email" placeholder="E-mail"><br>

        <input type="password" name="password" id="password" placeholder="Senha"><br>

        <input type="password" name="passwordVerify" id="passwordVerify" placeholder="Verificar Senha"><br><br>

        <button type="submit">Cadastrar</button>

        <a href="./adminPage.php">AdminPage</a>

        <?php if(!empty($m)): ?>
            <p> <?= $m ?></p>
        <?php endif; ?>

    </form>

</body>
</html>