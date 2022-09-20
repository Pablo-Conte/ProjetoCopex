<?php
require_once "../../../includes/connection.php";
require_once "./studentAuth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/default.css">
    <link rel="stylesheet" href="../../css/listVacancy.css">
    <script src="../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Listar Vagas</title>
</head>

<body>

    <?php
    require_once "../structure/headerUsers.php";
    ?>

    <div class="main">
        <h1>Listar vagas</h1>
        <div class="listar">
            <?php
            $query = $conn->prepare("SELECT * FROM vaga");
            $query->execute();
            $curso = "";
            $empresa = "";
            
            while ($results = $query->fetch(PDO::FETCH_ASSOC)) {
            
                if ($results["curso"] == 1) {
                    $curso = "Informática";
                }
                if ($results["curso"] == 2) {
                    $curso = "Eletromecânica";
                }
                
                $idEmpresa = $results['id_emp'];

                $query1 = $conn->prepare("SELECT nome FROM empresa WHERE id_empresa = :idempresa");
                $query1->bindParam(":idempresa", $results['id_emp']);
                $query1->execute();
                $empresa = $query1->fetch(PDO::FETCH_ASSOC)['nome'];

                echo "<form method='POST' action='./registerInterest.php'>";
                echo "<div class='vaga'>";
                echo "<div class='nomeEmpresa'>" . $empresa . "</div>";
                echo "<div class='corpoVaga'>";
                echo "<p>Vaga: " . $results["cargo"] . "</p>";
                echo "<p>Salário: " . $results["salario"] . "</p>";
                echo "<p>Curso: " . $curso . "</p>";
                echo "</div>";
                echo "<input type='hidden' value='$idEmpresa' name='idEmpresa'></input>";
                echo "<button type='submit'>Registrar Interesse</button>";
                echo "</div>";
                echo "</form>";
            }
            ?>
        </div>
    </div>



</body>

</html>