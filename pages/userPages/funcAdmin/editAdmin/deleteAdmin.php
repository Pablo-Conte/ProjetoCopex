<?php
    include_once '../../../../includes/connection.php';
    $idVaga = $_POST['idAdmin'];

    $query = $conn->prepare("DELETE FROM administrador WHERE id_administrador = $idVaga");

    $query->execute();

    header("location: ./editAdmin.php");

?>