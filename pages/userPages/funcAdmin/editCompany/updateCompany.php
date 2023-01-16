<?php

    require('../../../../includes/connection.php');
    
    $cnpj = $_POST['cnpj'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idEmpresa = $_POST['idEmpresa'];

    $query = $conn->prepare("UPDATE empresa SET cnpj = :cnpj, nome = :nome, email = :email where id_empresa = :idEmpresa");
    $query->bindParam(':cnpj', $cnpj);
    $query->bindParam(':nome', $nome);
    $query->bindParam(':email', $email);
    $query->bindParam(':idEmpresa', $idEmpresa);
    $query->execute();

    $results = $query->fetch(PDO::FETCH_ASSOC);

    header("location: ./editCompany.php");
?>