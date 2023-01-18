<?php
require_once "login/loginAuth.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\csslogin.css">
    <script src="../library/jquery/jquery.min.js"></script>
    <title>login</title>
</head>
<body>
    <header class="header">
        <a href="">COPEX Estágios</a>
        <ul>
            <li>
                <a href=".././index.php" class="links">Voltar</a>
            </li>
        </ul>
    </header>
    <main class="main">
        <div class="main1">
            <div class="mainItem">      
                <label value="Estudante" name="opcao" class="mainOpcao" id="Estudante">Estudante</label>
                <label value="Administrador" name="opcao" class="mainOpcao" id="Administrador">Administrador</label>
                <label value="Empresa" name="opcao" class="mainOpcao" id="Empresa">Empresa</label>
            </div>
            <div class="mainForm">
                <div id="tab1" style="display: block;">
                    <form action="login.php" method="POST" class="form">
                        <h2>Entrar como aluno</h2>
                        <input class="formInput" type="text" placeholder="Digite sua matricula" name="matricula">
                        <input class="formInput" type="password" placeholder="Digite sua senha" name="password_aluno">
                        <button type="submit" class="btnForm">Entrar</button>
                    </form>
                </div>
                <div id="tab2" style="display: none;">
                    <form action="login.php" method="POST" class="form">
                        <h2>Entrar como administrador</h2>
                        <input class="formInput" type="name" placeholder="Digite seu SIAPE" name="siape">
                        <input class="formInput" type="password" placeholder="Digite sua senha" name="password">
                        <button type="submit" class="btnForm">Entrar</button>
                    </form>
                </div>
                <div id="tab3" style="display: none;">
                    <form action="login.php" method="POST" class="form">
                        <h2>Entrar como empresa</h2>
                        <input class="formInput" type="text" placeholder="Digite seu CNPJ" name="cnpj">
                        <input class="formInput" type="password" placeholder="Digite sua senha" name="password_empresa">
                        <button type="submit" class="btnForm">Entrar</button>
                    </form>
                </div>    
            </div>
        </div>
    </main>
</div>
    <?php if (!empty($message)) : ?>
    <p> <?= $message ?></p>
    <?php endif; ?>
    
    <script>
        var a = "";
        $(window).load(function() {           
            $('.mainOpcao').on('click', function(label) {  
                a = label.currentTarget.id;
                if ((a == "Administrador") || (a == "Estudante") || (a == "Empresa")) { 
                    if ((a == "Administrador")) {
                        document.getElementById('tab1').style.display = 'none';
                        document.getElementById('tab2').style.display = 'block';
                        document.getElementById('tab3').style.display = 'none';
                    } else if ((a == "Estudante")) {
                        document.getElementById('tab1').style.display = 'block';
                        document.getElementById('tab2').style.display = 'none';
                        document.getElementById('tab3').style.display = 'none';
                    } else if ((a == "Empresa")) {
                        document.getElementById('tab1').style.display = 'none';
                        document.getElementById('tab2').style.display = 'none';
                        document.getElementById('tab3').style.display = 'block';
                    }
                }
            });
        });
    </script>

</body>
</html>