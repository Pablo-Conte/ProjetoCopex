<?php 
    require_once '../../includes/connection.php';

    session_start();

    if(!isset($_SESSION['user_id_aluno'])){
        header("Location: /projetocopex/pages/login.php");
        die();
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/headerHome.css">
    <link rel="stylesheet" href="../css/studentPage.css">
    <script src="../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Home do Estudante</title>
</head>
<body>
    <?php
        require_once './headerHome.php'
    ?>
    <div class="page">
        <div class="perfil">
            <div class="user">
                <h1><?php echo($_SESSION['name']);?></h1>
                <p>
                    <?php 
                        $query = $conn->prepare("SELECT curso FROM aluno WHERE id_aluno = :id");
                        $query->bindParam(':id', $_SESSION['user_id_aluno']);
                        $query->execute();
                        $results = $query->fetch(PDO::FETCH_DEFAULT);
                        if ($results == false){
                            $results = [];
                        }
                        echo $results['curso'];
                    ?>
                </p>
            </div>

            <div class="nomeAdmin">
                <h2>Registros de interesse</h2>
                <p>
                    nº
                    <?php 
                        // $query = "SELECT * FROM aluno";
                        // $records = $conn->prepare($query);
                        // $records->execute();
                        // $results = $records->fetchAll(PDO::FETCH_DEFAULT);
                        // if ($results == false){
                        //     $results = [];
                        // }
                        // echo(count($results));
                    ?>
                </p>
                <a href="">Ver interesses</a>
            </div>
        </div>
        <div class="funcoes">
            <h1>Vagas Abertas</h1>
            <div class="sessao">
            <div class="listar">
                <?php
                    $query = $conn->prepare("SELECT * FROM vaga");
                    $query->execute();
                    $curso = "";
                    $empresa = "";

                    while ($results = $query->fetch(PDO::FETCH_ASSOC)) {
                        
                        $idEmpresa = $results['id_emp'];
                        $cargo = $results['cargo'];

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
                        echo "</div>";
                        echo "<input type='hidden' value='$idEmpresa' name='idEmpresa'></input>";
                        echo "<input type='hidden' value='$cargo' name='cargo'></input>";
                        echo "<button type='submit'>Registrar Interesse</button>";
                        echo "</div>";
                        echo "</form>";
                    }
                ?>
        </div>
            </div>
        </div>
        
    </div>
</body>
</html>
