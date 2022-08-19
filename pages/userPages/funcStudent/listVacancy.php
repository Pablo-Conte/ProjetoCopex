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
</head>
<body>
    <h1>Listar vagas</h1>
    
    <table>
        
        <thead>
            <tr>
                <th scope="col">id_vaga</th>
                <th scope="col">Salário</th>
                <th scope="col">Curso</th>
                <th scope="col">Cargo</th>
                <th scope="col">Descrição</th>
                <th scope="col">id_emp</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = $conn->prepare("SELECT * FROM vaga");
                $query->execute();

                //var_dump($results);
                
                while ($results = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr>";
                    echo "<td>".$results["id_vaga"]."</td>";
                    echo "<td>".$results["salario"]."</td>";
                    echo "<td>".$results["curso"]."</td>";
                    echo "<td>".$results["cargo"]."</td>";
                    echo "<td>".$results["descricao"]."</td>";
                    echo "<td>".$results["id_emp"]."</td>";
                }
            ?>
        </tbody>
    </table>
    
    <br><a href="../studentPage.php">companyPage</a>
</body>
</html>