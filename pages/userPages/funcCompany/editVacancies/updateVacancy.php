<?php

require('../../../../includes/connection.php');

session_start();

if (!isset($_SESSION['user_id_empresa'])) {
    header("Location: /projetocopex/pages/login.php");
    die();
}

$cargo = $_POST['cargo'];
$salario = $_POST['salario'];
$curso = $_POST['curso'];
$descrição = $_POST['descricao'];
$idVaga = $_POST['idVaga'];

$query = $conn->prepare("UPDATE vaga SET cargo = :cargo, salario = :salario, curso = :curso where id_Vaga = :idVaga");
$query->bindParam(':cargo', $cargo);
$query->bindParam(':salario', $salario);
$query->bindParam(':curso', $curso);
$query->bindParam(':idVaga', $idVaga);
$query->execute();

$results = $query->fetch(PDO::FETCH_ASSOC);

header("location: ./editVacancy.php");
