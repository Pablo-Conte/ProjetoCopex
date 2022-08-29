<?php 
    require_once "../../../includes/connection.php";
    require_once "./adminAuth.php";
    require_once "../structure/headerUsers.php";

    if(!empty($_POST['matricula']) && !empty($_POST['password'] && !empty($_POST['name']) && !empty($_POST['email']))){
        if ($_POST['password'] == $_POST['passwordVerify']){
            
            $matricula = $_POST['matricula'];
            $email = $_POST['email'];
            $nome = $_POST['name'];
            $curso = $_POST['curso'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = $conn->prepare("SELECT * FROM aluno WHERE matricula = :matricula OR email = :email");
            $query->bindParam(':matricula', $matricula);
            $query->bindParam(':email', $email);
            $query->execute();

            $results = $query->fetch(PDO::FETCH_ASSOC);

            if($results == 0){
                $query = $conn->prepare("INSERT INTO aluno (
                    nome,     
                    senha,     
                    matricula,     
                    email,
                    curso
                ) VALUES (  
                    :nome,     
                    :senha,     
                    :matricula,     
                    :email,
                    :curso
                )");

                $query->bindParam(':nome', $nome);
                $query->bindParam(':senha', $password);
                $query->bindParam(':matricula', $matricula);
                $query->bindParam(':email', $email);
                $query->bindParam(':curso', $curso);

                $query->execute();

                $m = "<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!')</script>";

            } else {
                $m = 'Usuário já cadastrado';
            }
            
        } else {
            $m = 'Senhas não iguais, verifique!';
        }

    }


?>
    
    <div class="main">
        <form method="POST" action="registerAluno.php">
            <h1>Registro de Alunos</h1>
            <input type="text" name="matricula" id="matricula" placeholder="Matricula"><br>
            <input type="text" name="name" id="name" placeholder="Name"><br>
            <input type="email" name="email" id="email" placeholder="E-mail"><br>
            <input type="password" name="password" id="password" placeholder="Senha"><br>
            <input type="password" name="passwordVerify" id="passwordVerify" placeholder="Verificar Senha"><br><br>
            <select name="curso">
                <option value="1">Informática</option>
                <option value="2">Eletromecânica</option>
            </select></br></br>
            <button type="submit">Cadastrar</button>
            <?php if(!empty($m)): ?>
                <p> <?= $m ?></p>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>