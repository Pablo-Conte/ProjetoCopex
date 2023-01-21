<?php 
    require_once '../../includes/connection.php';
    session_start();

    if(!isset($_SESSION['user_id_empresa'])){
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
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/headerHome.css">
    <link rel="stylesheet" href="../css/company/companyPage.css">
    <script src="../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Home da Empresa</title>
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
                <p>Vagas Cadastradas</p>
                <p>
                    <?php
                        $query = "SELECT * FROM vaga where id_emp = $_SESSION[user_id_empresa]";
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

                        if ($results == false){
                            $results = [];
                        }
                        echo($quantidade);
                    ?>
                </p>
            </div>
            
        </div>
        <div class="funcoes">
            <h1>Vagas</h1>
            <div class="sessao">
                <a class="linksFunc" href="./funcCompany/registerVacancy/addVacancy.php">
                    <div class="botaoRegistro">
                        Cadastrar
                    </div>
                </a>
                <a class="linksFunc" href="./funcCompany/editVacancies/editVacancy.php">
                    <div class="botaoRegistro">
                        Editar
                    </div>
                </a>
            </div>
            <h1>Interesses</h1>
            <div class="sessao">
                <a class="linksFunc" data-bs-toggle='modal' data-bs-target='#JanelaModalShowInterest'>
                    <div class="botaoRegistro">
                        Visualizar
                    </div>
                </a>
                
            </div>
        </div>

        <div id="JanelaModalShowInterest" class="modal fade " tabindex="-1" >';
            <div class='modal-dialog modal-xl'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Interesses</h1>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <table>
                            <tr>
                                <th>-</th>
                                <th>Nome</th>
                                <th>-</th>
                                <th class='respInterest'>-</th>
                                <th>vaga</th>
                                <th>Currículo</th>
                            </tr>

                            <?php
                                $idEmp = $_SESSION['user_id_empresa'];
                                $queryInterestVacancy = $conn->prepare("SELECT id_vaga, cargo FROM vaga WHERE id_emp = $_SESSION[user_id_empresa]");
                                $queryInterestVacancy->execute();
                                while ($resultQueryInterest = $queryInterestVacancy->fetch(PDO::FETCH_ASSOC)) {
                                    $queryVagaAluno = $conn->prepare("SELECT id_aluno FROM vaga_aluno WHERE id_vaga = $resultQueryInterest[id_vaga]");
                                    $queryVagaAluno->execute();

                                    while ($resultQueryVagaAluno = $queryVagaAluno->fetch(PDO::FETCH_ASSOC)) {
                                        $queryNomeAluno = $conn->prepare("SELECT * FROM aluno WHERE id_aluno = $resultQueryVagaAluno[id_aluno]");
                                        $queryNomeAluno->execute();

                                        $resultNome = $queryNomeAluno->fetch();

                                        echo "<tr>";
                                        echo "      <td><div class='simboloCirculo'></div></td>";
                                        echo "      <td><div class='nome'>$resultNome[nome]</div></td>";
                                        echo "      <td class='respInterest'><img class='seta' src='../../imagens/seta.png' alt=''></td>";
                                        echo "      <td><div class='simboloQuadrado'></div></td>";
                                        echo "      <td><div class='vaga'>$resultQueryInterest[cargo]</div></td>";
                                        echo "      <td><img class='curriculo' src='../../imagens/vaga.png' alt=''></td>";
                                        echo "</tr>";
                                    }
                                }
  
                            ?>
                        </table>
                    </div> 
                </div>
            </div>
        </div>

        
    </div>
</body>
</html>
