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
    <link rel="stylesheet" href="../../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/default.css">
    <script src="../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Listar Vagas</title>
</head>

<body>

<?php
    require_once "../structure/headerUsers.php";
?>
    <link rel="stylesheet" href="./listVacancy.css">
    
    <div class="main">
        <h1>Listar vagas</h1>
        
        <?php
            $query = $conn->prepare("SELECT * FROM vaga");
            $query->execute();
            //var_dump($results);
            $curso = "";
            $empresa = "";
            
            while ($results = $query->fetch(PDO::FETCH_ASSOC)){
                if ($results["curso"] == 1){
                    $curso = "Informática";
                }
                if ($results["curso"] == 2){
                    $curso = "Eletromecânica";
                }
                
                $query1 = $conn->prepare("SELECT nome FROM empresa WHERE id_empresa = :idempresa");
                $query1->bindParam(":idempresa", $results['id_emp']);
                $query1->execute();
                $empresa = $query1->fetch(PDO::FETCH_ASSOC)['nome'];

                echo "<div class='vaga'>";
                echo "<p>Cargo: ".$results["cargo"]."</p>";
                echo "<p>Salário: ".$results["salario"]."</p>";
                echo "<p>Curso: ".$curso."</p>";
                echo "<p>Descrição: ".$results["descricao"]."</p>";
                echo "<p>".$empresa."</p>";
                echo "<button>Registrar interesse</button>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>