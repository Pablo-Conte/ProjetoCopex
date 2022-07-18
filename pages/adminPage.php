<?php 
    require '../config/connection.php';
    
    session_start();
    
    echo($_SESSION['user_id']);
    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id_administrador, siape_administrador, senha_administrador FROM administrador WHERE id_administrador = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $user = null;
    
        if (count($results) > 0) {
          $user = $results;
        }
      }
?>
<h1>Welcome to the Admin Page</h1>