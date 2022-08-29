<?php 
    require_once '../../includes/connection.php';
    require_once './headerHome.php'; 

    if(!isset($_SESSION['user_id_aluno'])){
        header("Location: /projetocopex/pages/login.php");
        die();
        
    }
?>
    <div class="main">
        <h1>Welcome to the Student Page</h1>
        <p>Nome do Aluno: <?php echo($_SESSION['name']);?></p>

        <a href="./funcStudent/listVacancy.php"><p>LISTAR VAGAS</p></a>
    </div>
</body>
</html>
