<?php
    $error = "";
    
    if (isset($_GET['msg'])){
        $error = $_GET['msg'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/error.css">
</head>
<body>
    <div class="error">
        <h1>Opa!</h1>
        <bold><h3>Erro: Contate nosso suporte!</h3></bold>
        <p><?php echo $error; ?></p>
        <button onclick="window.location.href='../index.php'">Voltar para Home</button>
    </div>
</body>
</html>