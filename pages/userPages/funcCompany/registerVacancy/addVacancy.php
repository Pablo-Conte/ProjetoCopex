<?php

    require_once('../../../../includes/connection.php');
    require_once('../companyAuth.php');

    if (!empty($_POST['salario']) && !empty($_POST['cargo']) && !empty($_POST['descricao'])){

        $query = $conn->prepare('INSERT INTO vaga (
            salario,
            curso,
            cargo,
            descricao,
            id_emp
        ) VALUES (
            :salario,
            :curso,
            :cargo,
            :descricao,
            :id_emp
        )');

        $salario = $_POST['salario'];
        $curso = $_POST['curso'];
        $cargo = $_POST['cargo'];
        $descricao = $_POST['descricao'];
        $idEmp = $_SESSION['user_id_empresa'];

        $query->bindParam(':salario', $salario);
        $query->bindParam(':curso', $curso);
        $query->bindParam(':cargo', $cargo);
        $query->bindParam(':descricao', $descricao);
        $query->bindParam(':id_emp', $idEmp);

        try {
            $query->execute();
            $_SESSION['messageInformation'] = 'Vaga Cadastrada!';
            $corToast = 'green';
        } catch (Exception $err) {
            $_SESSION['messageInformation'] = "Ocorreu um erro ao Criar a vaga, verifique se todos os dados estão corretos";
            $corToast = 'red';
        }

        
        
    } else {
        if(isset($_POST['singup'])) {
            if (empty($_POST['salario'] || $_POST['cargo'] || $_POST['descricao'])) {
                $_SESSION['messageInformation'] = "Por favor, preencha todos os dados do formulário";
                $corToast = '#0dc1fd';
            }
        }


    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/company/registerVacancy/registerVacancy.css">
    <script src="../../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Adicionar Vagas</title>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>

<body>

<nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../login.php">COPEX</a>
            <div class="voltar">
                <a href="../../../login.php">Voltar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">COPEX</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">

                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="../../../login.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../../sair.php">Logout</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>

    <div class="center">
        <div class="register">
            <h1>Registro de Vaga</h1>
            <form method="POST" action="./addVacancy.php">
                <div class="cargoCurso">
                    <input class='cargo' type="text" placeholder="Cargo" name="cargo">
                    <select class='curso' name="curso">
                        <option value="Informática">Informática</option>
                        <option value="Eletromecânica">Eletromecânica</option>
                    </select>
                </div>
                <div><input class="salario" type="text" placeholder="Salário" name="salario"></div>
                <div class="descricao"><textarea type="text" placeholder="Descrição" name="descricao"></textarea></div>
                <input class="button" type="submit" name="singup" value="Criar vaga">
            </form>
        </div>
    </div>
    <?php 
        if (!empty($_SESSION['messageInformation'])){
            
            
            echo "
            <div class='toast-container position-fixed top-0 end-0 p-0'>
                <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style='background-color: white;'>
                    <div class='toast-header' style='background-color: $corToast; color: white'>
                        <strong class='me-auto'>Informativo!</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                    </div>
                    <div class='toast-body'>
                        $_SESSION[messageInformation]
                    </div>
                </div>
            </div>";


            echo "
                <script>
                    const toastLiveExample = document.getElementById('liveToast')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                </script>
            ";

            $_SESSION['messageInformation'] = '';

        }
    ?>
</body>
</html>