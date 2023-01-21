<?php 
    require_once '../../includes/connection.php';
    session_start();

    if(!isset($_SESSION['user_id_admin'])){
        header("Location: ../projetocopex/pages/login.php");
        die();
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/admin/adminPage.css">
    <script src="../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Home do administrador</title>
</head>
<body>
    <?php
        require_once './structure/headerUsers.php';
    ?>
    <div class="page">
        <div class="perfil">
            <div class="user">
                <h1><?php echo($_SESSION['name']);?></h1>
            </div>

            <div class="nomeAdmin">
                <p>Alunos Matriculados</p>
                <p>
                    <?php 
                        $query = "SELECT * FROM aluno";
                        $records = $conn->prepare($query);
                        $records->execute();
                        $results = $records->fetchAll(PDO::FETCH_DEFAULT);
                        if ($results == false){
                            $results = [];
                        }
                        echo(count($results));
                    ?>
                </p>
            </div>

            <div class="nomeAdmin">
                <p>Empresas Cadastradas</p>
                <p>
                    <?php 
                        $query = "SELECT * FROM empresa";
                        $records = $conn->prepare($query);
                        $records->execute();
                        $results = $records->fetchAll(PDO::FETCH_DEFAULT);
                        if ($results == false){
                            $results = [];
                        }
                        echo(count($results));
                    ?>
                </p>
            </div>

            <div class="nomeAdmin">
                <p>Vagas Ofertadas</p>
                <p>
                    <?php 
                        $query = "SELECT * FROM vaga";
                        $records = $conn->prepare($query);
                        $records->execute();
                        $results = $records->fetchAll(PDO::FETCH_DEFAULT);
                        if ($results == false){
                            $results = [];
                        }
                        echo(count($results));
                    ?>
                </p>
            </div>
            
        </div>
        <div class="funcoes">
            <h1>Cadastros</h1>
            <div class="sessao">
                <a class="linksFunc" href="./funcAdmin/register/registerAluno.php">
                    <div class="botaoRegistro">
                        Aluno
                    </div>
                </a>
                <a class="linksFunc" href="./funcAdmin/register/registerEmpresa.php">
                    <div class="botaoRegistro">
                        Empresa
                    </div>
                </a>
                <a class="linksFunc" href="./funcAdmin/register/registerAdmin.php">
                    <div class="botaoRegistro">
                        Admin
                    </div>
                </a>
            </div>
            <h1>Edição</h1>
            <div class="sessao">
                <a class="linksFunc" href="./funcAdmin/editStudent/editStudent.php">
                    <div class="botaoRegistro">
                        Aluno
                    </div>
                </a>
                <a class="linksFunc" href="./funcAdmin/editCompany/editCompany.php">
                    <div class="botaoRegistro">
                        Empresa
                    </div>
                </a>
                <a class="linksFunc" href="./funcAdmin/editAdmin/editAdmin.php">
                    <div class="botaoRegistro">
                        Admin
                    </div>
                </a>
            </div>
        </div>
    </div>
    
</body>
</html>
