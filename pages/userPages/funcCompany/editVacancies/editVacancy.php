<?php
require_once '../../../../includes/connection.php';
session_start();

if (!isset($_SESSION['user_id_empresa'])) {
    header("Location: /projetocopex/pages/login.php");
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
    <link rel="stylesheet" href="../../../css/company/editVacancies/editVacancies.css">
    <script src="../../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Editar Vagas</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../login.php">COPEX</a>
            <div class="voltar" style="display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;">
                <a href="../../../login.php" style="margin-bottom: 0px;
    margin-right: 10%;
    font-size: larger;
    color: white;
    text-decoration: none;">Voltar</a>
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
    <div class="page">
        <div class="perfil">
            <div class="user">
                <h1><?php echo ($_SESSION['name']); ?></h1>
            </div>

            <div class="nomeAdmin">
                <p>Vagas Cadastradas</p>
                <p>
                    <?php
                    $query = "SELECT * FROM vaga where id_emp = $_SESSION[user_id_empresa]";
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
                <p>Interessados</p>
                <p>
                    <?php
                    $query = $conn->prepare("SELECT id_vaga FROM vaga WHERE id_emp = $_SESSION[user_id_empresa]");
                    $query->execute();
                    $quantidade = 0;

                    while ($results = $query->fetch(PDO::FETCH_ASSOC)) {
                        $queryInteressados = $conn->prepare("SELECT id_vagaAluno FROM vaga_aluno WHERE id_vaga = $results[id_vaga]");
                        $queryInteressados->execute();
                        $resultsInteressados = $queryInteressados->fetchAll(PDO::FETCH_ASSOC);
                        if ($resultsInteressados > 0) {
                            $quantidade = $quantidade + count($resultsInteressados);
                        }
                    }

                    if ($results == false) {
                        $results = [];
                    }
                    echo ($quantidade);
                    ?>
                </p>
            </div>
        </div>
        <div class="funcoes">
            <form method="post" action="./editVacancy.php">
                <input type="text" placeholder="Cargo" spellcheck="false" name='search'>
                <button type="submit"><img src="../../../../imagens/lupa.png" alt=""></button>
                <button type="submit"><img src="../../../../imagens/refresh.png" alt=""></button>
            </form>
            <?php
            $idEmp = $_SESSION['user_id_empresa'];
            $query = $conn->prepare("SELECT id_emp, cargo, curso, salario, descricao, id_vaga FROM vaga WHERE id_emp = $idEmp");

            if (!empty($_POST['search'])) {
                $query = $conn->prepare("SELECT id_emp, cargo, curso, salario, descricao, id_vaga FROM vaga WHERE cargo LIKE '%$_POST[search]%'");
            }

            $query->execute();
            $curso = "";
            $empresa = "";
            echo "<div class='ok'>";
            echo "<table class='table table-striped'>";
            echo     "<tr>";
            echo         "<th>Cargo</th>";
            echo         "<th>Curso</th>";
            echo         "<th class='resp'>Salario</th>";
            echo         "<th></th>";
            echo     "</tr>";
            while ($results = $query->fetch(PDO::FETCH_ASSOC)) {
                echo     "<tr>";
                echo         "<td>$results[cargo]</td>";
                echo         "<td>$results[curso]</td>";
                echo         "<td class='resp'>$results[salario]</td>";
                echo         "<td><button type='button' class='botaoModalInfo btn btn-primary' data-bs-toggle='modal' data-bs-target='#JanelaModalStudent" . $results['id_vaga'] . "'>Editar</button></td>";
                echo     "</tr>";

                echo "<form method='POST' action='./updateVacancy.php'>";

                echo "<div id='JanelaModalStudent$results[id_vaga]' class='modal fade' tabindex='-1' >";
                echo "<div class='modal-dialog'>";
                echo '<div class="modal-content">';
                echo '    <div class="modal-header">';
                echo "        <h3 class='modal-title'>Cargo: $results[cargo]</h3>";
                echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                echo '    </div>';

                echo '    <div class="modal-body">';
                echo '      <h5>Cargo</h5>';
                echo "      <input name='cargo' type='text' spellcheck='false' value='$results[cargo]'>";
                echo "      <h5>Salario</h5>";
                echo "      <input name='salario' type='text' spellcheck='false' value='$results[salario]'>";
                echo "      <h5>Curso</h5>";
                echo "      <select name='curso'>";
                echo "          <option>Informatica</option>";
                echo "          <option>Eletromecânica</option>";
                echo "      </select>";
                echo "      <h5>Descrição</h5>";
                echo "      <textarea name='descricao' type='text' style='border: 1px solid black; width: 100%; height: 20vh;' spellcheck='false'>$results[descricao]</textarea>";
                echo "      <input name='idVaga' type='text' value='$results[id_vaga]' hidden>";
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