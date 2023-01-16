<?php

    require('../../../../includes/connection.php');
    
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $idAluno = $_POST['idAluno'];

    $query = $conn->prepare("UPDATE aluno SET matricula = :matricula, nome = :nome, curso = :curso, email = :email, numero = :numero where id_aluno = :idAluno");
    $query->bindParam(':matricula', $matricula);
    $query->bindParam(':nome', $nome);
    $query->bindParam(':curso', $curso);
    $query->bindParam(':email', $email);
    $query->bindParam(':numero', $numero);
    $query->bindParam(':idAluno', $idAluno);
    $query->execute();

    $results = $query->fetch(PDO::FETCH_ASSOC);

    header("location: ./editStudent.php");
?>