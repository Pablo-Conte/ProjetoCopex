<?php
    include_once '../../../../includes/connection.php';
    $idAluno = $_POST['idAluno'];

    $query = $conn->prepare("DELETE FROM aluno WHERE id_aluno = $idAluno");

    $query->execute();

    header("location: ./editStudent.php");

?>