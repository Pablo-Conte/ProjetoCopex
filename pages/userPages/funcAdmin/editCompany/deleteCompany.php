<?php
    include_once '../../../../includes/connection.php';
    $idEmpresa = $_POST['idEmpresa'];

    $query = $conn->prepare("DELETE FROM empresa WHERE id_empresa = $idEmpresa");

    $query->execute();

    header("location: ./editCompany.php");

?>