<?php
    require_once "../../../includes/connection.php";
    require_once "./studentAuth";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .vaga {
            border: 0.25em solid #000;
            padding: 10px;
            display: flex;
            justify-content: center;
            width: 400px;
            flex-direction: column;
        }
    </style>
</head>
<body>
    
    <h1>Listar vagas</h1>
    
    <?php 
        $query = $conn->prepare("SELECT * FROM vaga");
        $query->execute();

        //var_dump($results);
        
        while ($results = $query->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='vaga'>";
            echo "<p>".$results["id_vaga"]."</p>";
            echo "<p>".$results["salario"]."</p>";
            echo "<p>".$results["curso"]."</p>";
            echo "<p>".$results["cargo"]."</p>";
            echo "<p>".$results["descricao"]."</p>";
            echo "<p>".$results["id_emp"]."</p>";
            echo "<button>Registrar interesse</button>";
            echo "</div>";
        }
    ?>
    
    <br><a href="../studentPage.php">companyPage</a>
</body>
</html>