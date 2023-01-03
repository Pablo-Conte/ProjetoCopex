<?php

    require_once('../../../includes/connection.php');
    require_once('./companyAuth.php');

    if (!empty($_POST['salario']) && !empty($_POST['cargo']) && !empty($_POST['descricao'])){
        
        $query = $conn->prepare('INSERT INTO vaga (
            salario,
            curso,
            cargo,
            descricao,
            id_emp
        ) VALUES (
            :salario,
            :curso,
            :cargo,
            :descricao,
            :id_emp
        )');

        $salario = $_POST['salario'];
        $curso = $_POST['curso'];
        $cargo = $_POST['cargo'];
        $descricao = $_POST['descricao'];
        $idEmp = $_SESSION['user_id_empresa'];

        $query->bindParam(':salario', $salario);
        $query->bindParam(':curso', $curso);
        $query->bindParam(':cargo', $cargo);
        $query->bindParam(':descricao', $descricao);
        $query->bindParam(':id_emp', $idEmp);

        $query->execute();

        if ($query == true) {
            $m = "<script language='javascript' type='text/javascript'>alert('Vaga cadastrada com sucesso!')</script>";
        } else {
            $m = "Coisas estão erradas";
        }
        
    }

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
    <title>Adicionar Vagas</title>
</head>

<body>

<?php
    require_once "../structure/headerUsers.php";
?>

    <div class="main">
        <h1>Adicionar Vaga</h1>
        <form method="POST" action="./addVacancy.php">
            <input type="text" placeholder="Salário" name="salario"></br>
            <input type="text" placeholder="Cargo" name="cargo"></br>
            <input type="text" placeholder="Descrição" name="descricao"></br></br>
            <select name="curso">
                <option value="1">Informática</option>
                <option value="2">Eletromecânica</option>
            </select></br></br>
            <button>Criar vaga</button>
        </form>
        <?php if(!empty($m)): ?>
            <p> <?= $m ?></p>
        <?php endif; ?>
    </div>
</body>
</html>