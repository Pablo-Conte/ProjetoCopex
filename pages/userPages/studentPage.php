<?php 
    require_once '../../includes/connection.php';

    session_start();

    if(!isset($_SESSION['user_id_aluno'])){
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
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/headerHome.css">
    <link rel="stylesheet" href="../css/student/studentPage.css">
    <script src="../../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../../library/jquery/jquery.min.js"></script>
    <title>Home do Estudante</title>
</head>
<body>
    <?php
        require_once './structure/headerUsers.php';
    ?>
    <div class="page">
        <div class="perfil">
            <div class="user">
                <h1><?php echo($_SESSION['name']);?></h1>
                <p>
                    <?php 
                        $query = $conn->prepare("SELECT curso FROM aluno WHERE id_aluno = :id");
                        $query->bindParam(':id', $_SESSION['user_id_aluno']);
                        $query->execute();
                        $results = $query->fetch(PDO::FETCH_DEFAULT);
                        if ($results == false){
                            $results = [];
                        }
                        echo $results['curso'];
                    ?>
                </p>
            </div>

            <div class="nomeAdmin">
                <h2>Registros de interesse</h2>
                <p>
                    nº
                    <?php 
                        // $query = "SELECT * FROM aluno";
                        // $records = $conn->prepare($query);
                        // $records->execute();
                        // $results = $records->fetchAll(PDO::FETCH_DEFAULT);
                        // if ($results == false){
                        //     $results = [];
                        // }
                        // echo(count($results));
                    ?>
                </p>
                <button data-bs-toggle='modal' data-bs-target='#JanelaModalShowInterest'>Ver interesses</button>
            </div>
        </div>
        <div class="funcoes">
            <h1>Vagas Abertas</h1>
            <div class="sessao">
                <?php
                    $query = $conn->prepare("SELECT * FROM vaga");
                    $query->execute();
                    $curso = "";
                    $empresa = "";

                    while ($results = $query->fetch(PDO::FETCH_ASSOC)) {
                        
                        $idEmpresa = $results['id_emp'];
                        $cargo = $results['cargo'];
                        $idVaga = $results['id_vaga'];

                        $query1 = $conn->prepare("SELECT nome FROM empresa WHERE id_empresa = :idempresa");
                        $query1->bindParam(":idempresa", $results['id_emp']);
                        $query1->execute();
                        $empresa = $query1->fetch(PDO::FETCH_ASSOC)['nome'];

                        $queryJaInteressado = $conn->prepare("SELECT * FROM vaga_aluno WHERE id_aluno = $_SESSION[user_id_aluno] AND id_vaga = $idVaga");
                        $queryJaInteressado->execute();

                        if ($queryJaInteressado->fetch(PDO::FETCH_ASSOC) == 0){
                            echo "<form method='POST' action='./funcStudent/registerInterest.php'>";
                            echo "<div class='vaga'>";
                            echo "<div class='nomeEmpresa'>Empresa: " . $empresa . "</div>";
                            echo "<div class='corpoVaga'>";
                            echo "<p>Vaga: " . $results["cargo"] . "</p>";
                            echo "<p>Salário: " . $results["salario"] . "</p>";
                            echo "</div>";
                            echo "<input type='hidden' value='$idEmpresa' name='idEmpresa'></input>";
                            echo "<input type='hidden' value='$cargo' name='cargo'></input>";
                            echo "<input type='hidden' value='$idVaga' name='idVaga'></input>";
                            echo "<div class='botoesModais'>";
                            echo "<button type='submit' class='botaoModalRegistro'>Registrar Interesse</button>";
                            echo "<button type='button' class='botaoModalInfo' data-bs-toggle='modal' data-bs-target='#JanelaModalVaga" . $idVaga . "'>+</button>";
                            echo "</div>";
                            echo "</div>";
    
                            echo '<div id="JanelaModalVaga' . $idVaga . '" class="modal fade" tabindex="-1" >';
                            echo "<div class='modal-dialog'>";
                            echo '<div class="modal-content">';
                            echo '    <div class="modal-header">';
                            echo '        <h3 class="modal-title">Cargo: '. $cargo . '</h3>';
                            echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                            echo '    </div>';
    
                            echo '    <div class="modal-body">';
                            echo '        <p><strong>Empresa:</strong> '. $empresa . '</p>';
                            echo '        <p><strong>Descrição:</strong> '. $results["descricao"] . '</p>';
                            echo '    </div>';
    
                            echo '    <div class="modal-footer">';
                            echo '        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>';
                            echo '    </div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo "</form>";
                        }

                    }
                ?>
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
                                <th>Empresa</th>
                                <th>-</th>
                                <th class='respInterest'>-</th>
                                <th>vaga</th>
                                <th>Dados Empresa</th>
                            </tr>

                            <?php
                                
                                $queryVagaAluno = $conn->prepare("SELECT id_vaga FROM vaga_aluno WHERE id_aluno = $_SESSION[user_id_aluno]");
                                $queryVagaAluno->execute();

                                while ($resultQueryVagaAluno = $queryVagaAluno->fetch(PDO::FETCH_ASSOC)) {
                                    $queryNomeAluno = $conn->prepare("SELECT cargo, id_emp FROM vaga WHERE id_vaga = $resultQueryVagaAluno[id_vaga]");
                                    $queryNomeAluno->execute();
                                    $resultNome = $queryNomeAluno->fetch();


                                    $queryEmpresa = $conn->prepare("SELECT nome FROM empresa WHERE id_empresa = $resultNome[id_emp]");
                                    $queryEmpresa->execute();
                                    $resultEmpresa = $queryEmpresa->fetch();

                                    echo "<tr>";
                                    echo "      <td><div class='simboloCirculo'></div></td>";
                                    echo "      <td><div class='nome'>$resultNome[cargo]</div></td>";
                                    echo "      <td class='respInterest'><img class='seta' src='../../imagens/seta.png' alt=''></td>";
                                    echo "      <td><div class='simboloQuadrado'></div></td>";
                                    echo "      <td><div class='vaga'>$resultEmpresa[nome]</div></td>";
                                    echo "      <td><img class='curriculo' src='../../imagens/informacao.png' alt=''></td>";
                                    echo "</tr>";
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
