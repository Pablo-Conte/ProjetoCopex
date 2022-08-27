<?php
    require_once "./login/loginAuth.php";
?>
    
    <div>
        <h2>Login Admin</h2>
        <form action="login.php" method="POST">
            <input type="name" placeholder="Digite seu SIAPE" name="siape"></br>
            <input type="password" placeholder="Digite sua senha" name="password"></br></br>
            <button type="submit">Login</button>
        </form>
    </div>

    <div>
        <h2>Login Estudante</h2>
        <form action="login.php" method="POST">
            <input type="text" placeholder="Digite sua matricula" name="matricula"></br>
            <input type="password" placeholder="Digite sua senha" name="password_aluno"></br></br>
            <button type="submit">Login</button>
        </form>
    </div>

    <div>
        <h2>Login Empresa</h2>
        <form action="login.php" method="POST">
            <input type="name" placeholder="Digite seu CNPJ" name="cnpj"></br>
            <input type="password" placeholder="Digite sua senha" name="password_empresa"></br></br>
            <button type="submit">Login</button>
        </form>
    </div>

    <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
    <?php endif; ?>
</body>


</html>