<?php
require_once '../../../../includes/connection.php';
session_start();

if (!isset($_SESSION['user_id_admin'])) {
    header("Location: ../../projetocopex/pages/login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/admin/editStudent.css">
    <script src="../../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Home do administrador</title>
</head>

<body>
    <?php
        require_once '../../structure/headerFuncUser.php';
    ?>
    <div class="page">
        <div class="perfil">
            <div class="user">
                <h2>Admin</h2>
                <h1><?php echo ($_SESSION['name']); ?></h1>
            </div>

            <div class="nomeAdmin">
                <p>Alunos Matriculados</p>
                <p>
                    <?php
                    $query = "SELECT * FROM aluno";
                    $records = $conn->prepare($query);
                    $records->execute();
                    $results = $records->fetchAll(PDO::FETCH_DEFAULT);
                    if ($results == false) {
                        $results = [];
                    }
                    echo (count($results));
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
                    if ($results == false) {
                        $results = [];
                    }
                    echo (count($results));
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
                    if ($results == false) {
                        $results = [];
                    }
                    echo (count($results));
                    ?>
                </p>
            </div>

        </div>
        <div class="funcoes">
            <form action="">
                <input type="text" placeholder="Matricula" spellcheck="false">
                <button type="submit"><img src="../../../../imagens/lupa.png" alt=""></button>
            </form>
            <?php
                $query = $conn->prepare("SELECT matricula, nome, email, numero, curso, id_aluno FROM aluno");
                $query->execute();
                $curso = "";
                $empresa = "";
                echo "<div class='ok'>";
                echo "<table class='table table-striped'>";
                echo     "<tr>";
                echo         "<th>Matricula</th>";
                echo         "<th>Nome</th>";
                echo         "<th class='resp'>Número</th>";
                echo         "<th></th>";
                echo     "</tr>";
                while ($results = $query->fetch(PDO::FETCH_ASSOC)) {

                    echo     "<tr>";
                    echo         "<td>$results[matricula]</td>";
                    echo         "<td>$results[nome]</td>";
                    echo         "<td class='resp'>$results[numero]</td>";
                    echo         "<td><button type='button' class='botaoModalInfo btn btn-primary' data-bs-toggle='modal' data-bs-target='#JanelaModalStudent". $results['matricula'] ."'>Editar</button></td>";
                    echo     "</tr>";

                    echo "<form method='POST' action='./updateStudent.php'>";

                    echo "<div id='JanelaModalStudent$results[matricula]' class='modal fade' tabindex='-1' >";
                    echo "<div class='modal-dialog'>";
                    echo '<div class="modal-content">';
                    echo '    <div class="modal-header">';
                    echo "        <h3 class='modal-title'>Aluno: $results[nome]</h3>";
                    echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                    echo '    </div>';

                    echo '    <div class="modal-body">';
                    echo '      <h5>Matricula</h5>';
                    echo "      <input name='matricula' type='text' spellcheck='false' value='$results[matricula]'>";
                    echo "      <h5>Nome</h5>";
                    echo "      <input name='nome' type='text' spellcheck='false' value='$results[nome]'>";
                    echo "      <h5>Curso</h5>";
                    echo "      <input name='curso' type='text' spellcheck='false' value='$results[curso]'>";
                    echo "      <h5>Email</h5>";
                    echo "      <input name='email' type='text' spellcheck='false' value='$results[email]'>";
                    echo "      <input name='idAluno' type='text' value='$results[id_aluno]' hidden>";
                    echo '    </div>';

                    echo '    <div class="modal-footer">';
                    echo '        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Atualizar</button>';
                    echo '        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>';
                    echo '    </div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo "</form>";
                }
                echo "</table>";
                echo "</div>"
            ?>
        </div>

</body>

</html>