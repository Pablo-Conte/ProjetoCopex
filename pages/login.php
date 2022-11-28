<?php
require_once "./login/loginAuth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./css/headerIndex.css">
    <link rel="stylesheet" href="./css/headerHome.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="../library/jquery/jquery.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Login</title>
</head>

<body id="grad">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="../index.php" class="navbar-brand">COPEX</a>
            <form class="d-flex" role="search">
                <a href="../index.php">
                    <div class="dir">HOME</div>
                </a>
            </form>
        </div>
    </nav>
    <div class="main">
        <div>
            <div class="loginChoice">

                <label value="Administrador" name="opcao" class="opcao" id="Administrador">Administrador</label>
                <label value="Estudante" name="opcao" class="opcao" id="Estudante">Estudante</label>
                <label value="Empresa" name="opcao" class="opcao" id="Empresa">Empresa</label>

            </div>
            <div class="loginStyle">
                <div>
                    <div id="tab1" style="display: none;">
                        <div class="loginForm">
                            <h2>Login Admin</h2>
                            <form action="login.php" method="POST" class="data">
                                <input type="name" placeholder="Digite seu SIAPE" name="siape">
                                <input type="password" placeholder="Digite sua senha" name="password">
                                <button type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab2" style="display: block;">
                        <div class="loginForm">
                            <h2>Login Estudante</h2>
                            <form action="login.php" method="POST" class="data">
                                <input type="text" placeholder="Digite sua matricula" name="matricula">
                                <input type="password" placeholder="Digite sua senha" name="password_aluno">
                                <button type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab3" style="display: none;">
                        <div class="loginForm">
                            <h2>Login Empresa</h2>
                            <form action="login.php" method="POST" class="data">
                                <input type="name" placeholder="Digite seu CNPJ" name="cnpj">
                                <input type="password" placeholder="Digite sua senha" name="password_empresa">
                                <button type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                    <?php if (!empty($message)) : ?>
                        <p> <?= $message ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        var a = "";
        $(window).load(function() {
            
            $('.opcao').on('click', function(label) {
                
                a = label.currentTarget.id;

                if ((a == "Administrador") || (a == "Estudante") || (a == "Empresa")) {
                    
                    if ((a == "Administrador")) {
                        document.getElementById('tab1').style.display = "block";
                        document.getElementById('tab2').style.display = "none";
                        document.getElementById('tab3').style.display = "none";
                    } else if ((a == "Estudante")) {
                        document.getElementById('tab1').style.display = "none";
                        document.getElementById('tab2').style.display = "block";
                        document.getElementById('tab3').style.display = "none";
                    } else if ((a == "Empresa")) {
                        document.getElementById('tab1').style.display = "none";
                        document.getElementById('tab2').style.display = "none";
                        document.getElementById('tab3').style.display = "block";
                    }
                }

            });

        });
    </script>
</body>

</html>