<?php

    require('../../../../includes/connection.php');
    
    $siape = $_POST['siape'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idAdmin = $_POST['idAdmin'];

    $query = $conn->prepare("UPDATE administrador SET siape = :siape, nome = :nome, email = :email where id_administrador = :idAdmin");
    $query->bindParam(':siape', $siape);
    $query->bindParam(':nome', $nome);
    $query->bindParam(':email', $email);
    $query->bindParam(':idAdmin', $idAdmin);
    $query->execute();

    $results = $query->fetch(PDO::FETCH_ASSOC);

    header("location: ./editAdmin.php");
?>