<html>
<head>
    <title> Cadastro de Usuário </title>
</head>
<?php 
    require_once "../includes/connection.php";
    $m = "";

    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: /projetocopex/pages/login.php");
        die();
    }
    
    if (!empty($_POST['siape']) && !empty($_POST['password'] && !empty($_POST['name']) && !empty($_POST['email']))){
        
        $siape = $_POST['siape'];
        $password = $_POST['password'];
    
        $recordsSiape = $conn->prepare("SELECT siape_administrador FROM administrador WHERE siape_administrador = :siape");
        $recordsEmail = $conn->prepare("SELECT email_administrador FROM administrador WHERE email_administrador = :email");

        $recordsSiape->bindParam(':siape', $_POST['siape']);
        $recordsEmail->bindParam(':email', $_POST['email']);
    
        $recordsSiape->execute();
        $recordsEmail->execute();
        $resultsSiape = $recordsSiape->fetch(PDO::FETCH_ASSOC);
        $resultsEmail = $recordsEmail->fetch(PDO::FETCH_ASSOC);


        if ($resultsSiape == 0 && $resultsEmail == 0) {
            $query = $conn->prepare("INSERT INTO administrador (nome_administrador, senha_administrador, email_administrador, siape_administrador) VALUES (:nome, :senha, :email, :siape)");
            $query->bindParam(':nome', $_POST['name']);
            $query->bindParam(':senha', $_POST['password']);
            $query->bindParam(':email', $_POST['email']);
            $query->bindParam(':siape', $_POST['siape']);
            $query->execute();

            $results = $query->fetch(PDO::FETCH_ASSOC);
            $m = "<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!')</script>";
        } else {
            $m = "Siape ou Email já estão cadastrados no Banco de dados";
        }
    }
?>
<body>
    <form method="POST" action="register.php">

        <input type="text" name="siape" id="siape" placeholder="Siape"><br>

        <input type="text" name="name" id="name" placeholder="Nome"><br>
        
        <input type="email" name="email" id="email" placeholder="E-mail"><br>

        <input type="password" name="password" id="password" placeholder="Password"><br>

        <button type="submit">Cadastrar</button>
        <a href="./login.php">Login</a>
        <?php if(!empty($m)): ?>
            <p> <?= $m ?></p>
        <?php endif; ?>

    </form>
</body>
</html>