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
    <link rel="stylesheet" href="../../../css/admin/editAdmin/editAdmin.css">
    <script src="../../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Editar Administrador</title>
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
            <form method="post" action="./editAdmin.php">
                <input type="text" placeholder="Siape/Nome" spellcheck="false" name='search'>
                <button type="submit"><img src="../../../../imagens/lupa.png" alt=""></button>
                <button type="submit"><img src="../../../../imagens/refresh.png" alt=""></button>
            </form>
            <?php
                
                $query = $conn->prepare("SELECT siape, nome, email, id_administrador FROM administrador");  
                
                if (!empty($_POST['search'])){
                    $query = $conn->prepare("SELECT id_administrador, siape, nome, email, id_administrador FROM administrador WHERE id_administrador LIKE '%$_POST[search]%' or nome LIKE '%$_POST[search]%'");
                }

                $query->execute();
                $curso = "";
                $empresa = "";
                echo "<div class='ok'>";
                echo "<table class='table table-striped'>";
                echo     "<tr>";
                echo         "<th>Siape</th>";
                echo         "<th>Nome</th>";
                echo         "<th class='resp'>email</th>";
                echo         "<th></th>";
                echo     "</tr>";
                while ($results = $query->fetch(PDO::FETCH_ASSOC)) {

                    echo     "<tr>";
                    echo         "<td>$results[siape]</td>";
                    echo         "<td>$results[nome]</td>";
                    echo         "<td class='resp'>$results[email]</td>";
                    echo         "<td class='editExclude'><button type='button' class='botaoModalInfo btn btn-primary' data-bs-toggle='modal' data-bs-target='#JanelaModalStudent". $results['id_administrador'] ."'>Editar</button><button type='button' class='botaoModalInfo btn btn-danger close' data-bs-toggle='modal' data-bs-target='#JanelaModalStudentExclude" . $results['id_administrador'] . "'>X</button></td>";
                    echo     "</tr>";

                    echo "<form method='POST' action='./updateAdmin.php'>";

                    echo "<div id='JanelaModalStudent$results[id_administrador]' class='modal fade' tabindex='-1' >";
                    echo "<div class='modal-dialog'>";
                    echo '<div class="modal-content">';
                    echo '    <div class="modal-header">';
                    echo "        <h3 class='modal-title'>Admin: $results[nome]</h3>";
                    echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                    echo '    </div>';

                    echo '    <div class="modal-body">';
                    echo '      <h5>siape</h5>';
                    echo "      <input name='siape' type='text' spellcheck='false' value='$results[siape]'>";
                    echo "      <h5>Nome</h5>";
                    echo "      <input name='nome' type='text' spellcheck='false' value='$results[nome]'>";
                    echo "      <h5>Email</h5>";
                    echo "      <input name='email' type='text' spellcheck='false' value='$results[email]'>";
                    echo "      <input name='idAdmin' type='text' value='$results[id_administrador]' hidden>";
                    echo '    </div>';

                    echo '    <div class="modal-footer">';
                    echo '        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Atualizar</button>';
                    echo '        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>';
                    echo '    </div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    
                    echo "</form>";
                    echo "<form method='POST' action='./deleteAdmin.php'>";
                    echo "<div id='JanelaModalStudentExclude$results[id_administrador]' class='modal fade' tabindex='-1' >";
                    echo "<div class='modal-dialog'>";
                    echo '<div class="modal-content">';
                    echo '    <div class="modal-header">';
                    echo "        <h3 class='modal-title'>Cuidado!</h3>";
                    echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                    echo '    </div>';
    
                    echo '    <div class="modal-body">';
                    echo '      <h5>Você realmente quer excluir este administrador?</h5>';
                    echo "      <h5><strong>Administrador: </strong>$results[nome]</h5>";
                    echo "      <input type='text' hidden value='$results[id_administrador]' name='idAdmin'>";
                    echo '    </div>';
    
                    echo '    <div class="modal-footer">';
                    echo '        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>';
                    echo '        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>';
                    echo '    </div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</form>';
                }
                echo "</table>";
                echo "</div>"
            ?>
        </div>

</body>

</html>