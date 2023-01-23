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
    <link rel="stylesheet" href="../../../css/admin/editCompany/editCompany.css">
    <script src="../../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Editar Empresa</title>
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
             <form method="post" action="./editCompany.php">
                <input type="text" placeholder="CNPJ/Nome" spellcheck="false" name='search'>
                <button type="submit"><img src="../../../../imagens/lupa.png" alt=""></button>
                <button type="submit"><img src="../../../../imagens/refresh.png" alt=""></button>
            </form>
            <?php
                
                $query = $conn->prepare("SELECT nome, cnpj, email, id_empresa FROM empresa");  
                
                if (!empty($_POST['search'])){
                    $query = $conn->prepare("SELECT id_empresa, nome, cnpj, email, id_empresa FROM empresa WHERE cnpj LIKE '%$_POST[search]%' OR nome LIKE '%$_POST[search]%'");
                }
                
                $query->execute();
                $curso = "";
                $empresa = "";
                echo "<div class='ok'>";
                echo "<table class='table table-striped'>";
                echo     "<tr>";
                echo         "<th>CNPJ</th>";
                echo         "<th>Nome</th>";
                echo         "<th class='resp'>email</th>";
                echo         "<th></th>";
                echo     "</tr>";
                while ($results = $query->fetch(PDO::FETCH_ASSOC)) {

                    echo     "<tr>";
                    echo         "<td>$results[cnpj]</td>";
                    echo         "<td>$results[nome]</td>";
                    echo         "<td class='resp'>$results[email]</td>";
                    echo         "<td><button type='button' class='botaoModalInfo btn btn-primary' data-bs-toggle='modal' data-bs-target='#JanelaModalStudent". $results['id_empresa'] ."'>Editar</button></td>";
                    echo     "</tr>";

                    echo "<form method='POST' action='./updateCompany.php'>";

                    echo "<div id='JanelaModalStudent$results[id_empresa]' class='modal fade' tabindex='-1' >";
                    echo "<div class='modal-dialog'>";
                    echo '<div class="modal-content">';
                    echo '    <div class="modal-header">';
                    echo "        <h3 class='modal-title'>Empresa: $results[nome]</h3>";
                    echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                    echo '    </div>';

                    echo '    <div class="modal-body">';
                    echo '      <h5>cnpj</h5>';
                    echo "      <input name='cnpj' type='text' spellcheck='false' value='$results[cnpj]'>";
                    echo "      <h5>Nome</h5>";
                    echo "      <input name='nome' type='text' spellcheck='false' value='$results[nome]'>";
                    echo "      <h5>Email</h5>";
                    echo "      <input name='email' type='text' spellcheck='false' value='$results[email]'>";
                    echo "      <input name='idEmpresa' type='text' value='$results[id_empresa]' hidden>";
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