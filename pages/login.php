<?php 
    require_once '../includes/connection.php';

    session_start();

    if (isset($_SESSION['user_id'])){
        header('Location: adminPage.php');
    }
    if (!empty($_POST['siape']) && !empty($_POST['password'])){

        $query = "SELECT siape, senha, id_administrador, nome FROM administrador WHERE siape = :siape";

        $records = $conn->prepare($query);

        $records->bindParam(':siape', $_POST['siape']);
        
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        if ($results == false){
            $results = [];
        }

        $message = '';

        if (count($results) > 1 && password_verify($_POST['password'], $results['senha']) == TRUE){
            $_SESSION['user_id'] = $results["id_administrador"];
            $_SESSION['name'] = $results["nome"];
            header("Location: adminPage.php");
        } else {
            $message = 'Sorry, those credentials do not match';
        }
    
    } 
    
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
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="name" placeholder="Digite seu SIAPE" name="siape"></br>
            <input type="password" placeholder="Digite sua senha" name="password"></br></br>
            <button type="submit">Login</button>
            
            <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>


</html>