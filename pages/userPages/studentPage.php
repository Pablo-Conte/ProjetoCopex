<?php
require_once '../../includes/connection.php';

session_start();

if (!isset($_SESSION['user_id_aluno'])) {
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


    <?php
    if (!empty($_SESSION['messageInformation'])) {

        echo "
                    <div class='toast-container position-fixed' style='left: 50%;
                    position: fixed;
                    transform: translate(-50%, 0px);
                    z-index: 9999; border: none; margin-top: 2%'>
                        <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style='background-color: white;'>
                            <div class='toast-header' style='background-color: green; color: white'>
                                <strong class='me-auto'>Informativo!</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                            </div>
                            <div class='toast-body'>
                                $_SESSION[messageInformation]
                            </div>
                        </div>
                    </div>";


        echo "
                        <script>
                            const toastLiveExample = document.getElementById('liveToast')
                            const toast = new bootstrap.Toast(toastLiveExample)
                            toast.show()
                        </script>
                    ";

        $_SESSION['messageInformation'] = '';
    }


    ?>

    <div class="page">
        <div class="perfil">
            <div class="user">
                <h1><?php echo ($_SESSION['name']); ?></h1>
                <p>
                    <?php
                    $query = $conn->prepare("SELECT curso FROM aluno WHERE id_aluno = :id");
                    $query->bindParam(':id', $_SESSION['user_id_aluno']);
                    $query->execute();
                    $results = $query->fetch(PDO::FETCH_DEFAULT);
                    if ($results == false) {
                        $results = [];
                    }
                    echo $results['curso'];
                    ?>
                </p>
            </div>

            <div class="nomeAdmin">
                <h2>Registros de interesse</h2>
                <p>
                    <?php
                    $queryQuantidade = $conn->prepare("SELECT id_vaga FROM vaga_aluno WHERE id_aluno = $_SESSION[user_id_aluno]");
                    $queryQuantidade->execute();

                    echo count($queryQuantidade->fetchAll());
                    ?>
                </p>
                <button data-bs-toggle='modal' data-bs-target='#JanelaModalShowInterest'>Ver interesses</button>
            </div>
        </div>
        <div class="funcoes">
            <h1>Vagas Abertas</h1>
            <div class="sessao">
                <?php
                $queryAluno = $conn->prepare("SELECT curso FROM aluno WHERE id_aluno = $_SESSION[user_id_aluno]");
                $queryAluno->execute();
                $resultadoAluno = $queryAluno->fetch();
                $query = $conn->prepare("SELECT * FROM vaga WHERE curso = '$resultadoAluno[curso]'");
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

                    if ($queryJaInteressado->fetch(PDO::FETCH_ASSOC) == 0) {
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
                        echo '        <h3 class="modal-title">Cargo: ' . $cargo . '</h3>';
                        echo '        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>';
                        echo '    </div>';

                        echo '    <div class="modal-body">';
                        echo '        <p><strong>Empresa:</strong> ' . $empresa . '</p>';
                        echo '        <p><strong>Descrição:</strong> ' . $results["descricao"] . '</p>';
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
        <div id="JanelaModalShowInterest" class="modal fade " tabindex="-1">';
            <div class='modal-dialog modal-xl'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="center">Interesses</h1>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <table>

                            <?php


                            $queryVagaAluno = $conn->prepare("SELECT id_vaga FROM vaga_aluno WHERE id_aluno = $_SESSION[user_id_aluno]");
                            $queryVagaAluno->execute();

                            $queryVagaAluno2 = $conn->prepare("SELECT id_vaga FROM vaga_aluno WHERE id_aluno = $_SESSION[user_id_aluno]");
                            $queryVagaAluno2->execute();
                            $resultQueryVagaAluno2 = $queryVagaAluno2->fetchAll(PDO::FETCH_ASSOC);

                            if (count($resultQueryVagaAluno2) == 0) {
                                echo "<p class='center'>Você ainda não registrou interesse em alguma vaga!</p>";
                            } else {



                                echo "<tr>";
                                echo     "<th>-</th>";
                                echo     "<th>Vaga</th>";
                                echo     "<th>-</th>";
                                echo     "<th class='respInterest'>-</th>";
                                echo     "<th>Empresa</th>";
                                echo     "<th>Informações</th>";
                                echo "</tr>";

                                while ($resultQueryVagaAluno = $queryVagaAluno->fetch(PDO::FETCH_ASSOC)) {
                                    $queryNomeAluno = $conn->prepare("SELECT cargo, id_emp, descricao, id_vaga FROM vaga WHERE id_vaga = $resultQueryVagaAluno[id_vaga]");
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
                                    echo "      <td><img class='curriculo' src='../../imagens/informacao.png' alt='' type='button' class='botaoModalInfo' data-bs-toggle='modal' data-bs-target='#JanelaModalInteresse" . $resultNome['id_vaga'] . "'></td>";
                                    echo "</tr>";
                                }
                            }





                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php

        
        $queryVagaAluno3 = $conn->prepare("SELECT id_vaga FROM vaga_aluno WHERE id_aluno = $_SESSION[user_id_aluno]");
        $queryVagaAluno3->execute();
        while ($resultQueryVagaAluno = $queryVagaAluno3->fetch(PDO::FETCH_ASSOC)) {

            $queryNomeAluno = $conn->prepare("SELECT cargo, id_emp, descricao, id_vaga FROM vaga WHERE id_vaga = $resultQueryVagaAluno[id_vaga]");
            $queryNomeAluno->execute();
            $resultNome = $queryNomeAluno->fetch();

            $queryEmpresa = $conn->prepare("SELECT nome, email FROM empresa WHERE id_empresa = $resultNome[id_emp]");
            $queryEmpresa->execute();
            $resultEmpresa = $queryEmpresa->fetch();

            echo "<div class='modal fade' id='JanelaModalInteresse" . $resultNome['id_vaga'] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
            echo "      <div class='modal-dialog'>";
            echo "          <div class='modal-content'>";
            echo "              <div class='modal-header'>";
            echo "                <h1 class='modal-title fs-5' id='exampleModalLabel'>Interesse</h1>";
            echo "                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "              </div>";
            echo "              <div class='modal-body'>";
            echo "                  <h4>Empresa:</h4>";
            echo "                  <p>$resultEmpresa[nome]</p>";
            echo "                  <h4>Cargo:</h4>";
            echo "                  <p>$resultNome[cargo]</p>";
            echo "                  <h4>Descrição da Vaga: </h4>";
            echo "                  <p>$resultNome[descricao]</p>";
            echo "                  <h4>E-mail da empresa: </h4>";
            echo "                  <p>$resultEmpresa[email]</p>";
            echo "              </div>";
            echo "              <div class='modal-footer'>";
            echo "                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
            echo "              </div>";
            echo "          </div>";
            echo "       </div>";
            echo " </div>";
        }



        ?>
    </div>

</body>

</html>