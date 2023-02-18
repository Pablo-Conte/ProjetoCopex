<?php
    include_once '../../../../includes/connection.php';
    $idVaga = $_POST['idVaga'];

    $query = $conn->prepare("DELETE FROM vaga WHERE id_vaga = $idVaga");

    $query->execute();

    header("location: ./editVacancy.php");

?>