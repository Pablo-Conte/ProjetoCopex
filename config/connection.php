<?php

    $conn = mysqli_connect('localhost', 'root', '');
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }



    echo("Conectado ao banco");
?>