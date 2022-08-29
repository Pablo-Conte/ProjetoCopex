<?php 
    require_once '../../includes/connection.php';
    require_once './headerHome.php';
    session_start();
    

    if(!isset($_SESSION['user_id_admin'])){
        header("Location: ../projetocopex/pages/login.php");
        die();
        
    }
?>
    <div class="main">
        <h1>Welcome to the Admin Page</h1>
        <p>Nome do Admin: <?php echo($_SESSION['name']);?></p>
        <a href="./funcAdmin/register.php">Registrar ADM</a><br>
        <a href="./funcAdmin/registerEmpresa.php">Registrar EMPRESA</a><br>
        <a href="./funcAdmin/registerAluno.php">Registrar ALUNO</a><br></br>
    </div>
</body>
</html>
