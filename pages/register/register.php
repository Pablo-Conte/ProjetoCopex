<html>
<head>
    <title> Cadastro de Usuário </title>
</head>
<?php 
    require_once "../../includes/connection.php";
    require_once "./adminAuth.php";
    
    $m = "";
    
    if (!empty($_POST['siape']) && !empty($_POST['password'] && !empty($_POST['name']) && !empty($_POST['email']))){
        
        $siape = $_POST['siape'];
        $password = $_POST['password'];
    
        $recordsSiape = $conn->prepare("SELECT siape FROM administrador WHERE siape = :siape");
        $recordsEmail = $conn->prepare("SELECT email FROM administrador WHERE email = :email");

        $recordsSiape->bindParam(':siape', $_POST['siape']);
        $recordsEmail->bindParam(':email', $_POST['email']);
    
        $recordsSiape->execute();
        $recordsEmail->execute();
        $resultsSiape = $recordsSiape->fetch(PDO::FETCH_ASSOC);
        $resultsEmail = $recordsEmail->fetch(PDO::FETCH_ASSOC);


        if ($resultsSiape == 0 && $resultsEmail == 0) {
            $query = $conn->prepare("INSERT INTO administrador (nome, senha, email, siape) VALUES (:nome, :senha, :email, :siape)");
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $query->bindParam(':nome', $_POST['name']);
            $query->bindParam(':senha', $hash_password);
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

        <h1>Registro de Administradores</h1>

        <input type="text" name="siape" id="siape" placeholder="Siape"><br>

        <input type="text" name="name" id="name" placeholder="Nome"><br>
        
        <input type="email" name="email" id="email" placeholder="E-mail"><br>
        
        <input type="password" name="password" id="password" placeholder="Password"><br>

        <br>
        <button type="submit">Cadastrar</button>
        <a href="../userPages/adminPage.php">AdminPage</a>
        <?php if(!empty($m)): ?>
            <p> <?= $m ?></p>
        <?php endif; ?>

    </form>
</body>
</html>