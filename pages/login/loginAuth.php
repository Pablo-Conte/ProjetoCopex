<?php 
    
        require_once "$_SERVER[DOCUMENT_ROOT]/projetocopex/includes/connection.php";
    
        session_start();

        if (isset($_SESSION['user_id_admin'])){
            header('Location: ./userPages/adminPage.php');
        }

        if (isset($_SESSION['user_id_aluno'])){
            header('Location: ./userPages/studentPage.php');
        }

        if (isset($_SESSION['user_id_empresa'])){
            header('Location: ./userPages/companyPage.php');
        }

        //Login Administrador
        if (!empty($_POST['siape']) && !empty($_POST['password'])){

            $query = "SELECT siape, senha, id_administrador, nome FROM administrador WHERE siape = :siape";

            $records = $conn->prepare($query);

            $records->bindParam(':siape', $_POST['siape']);
            
            $records->execute();

            $results = $records->fetch(PDO::FETCH_ASSOC);
            
            if ($results == false){
                $results = [];
            }

            $message = '';

            if (count($results) > 1 && password_verify($_POST['password'], $results['senha']) == TRUE){
                $_SESSION['user_id_admin'] = $results["id_administrador"];
                $_SESSION['name'] = $results["nome"];
                $_SESSION['messageInformation'] = "";
                header("Location: ./userPages/adminPage.php");
            } else {
                $_SESSION["messageInformation"] = 'Credenciais incorretas!';
                $_SESSION['miColor'] = '#FA6E65';
            }
        
        } 
        
        //Login Estudante
        if(!empty($_POST['matricula']) && !empty($_POST["password_aluno"])){
            $query = "SELECT id_aluno, nome, senha, numero, email FROM aluno WHERE matricula = :matricula";
            $records = $conn->prepare($query);
            $records->bindParam(':matricula', $_POST['matricula']);
            $records->execute();

            $results = $records->fetch(PDO::FETCH_ASSOC);

            if ($results == false){
                $results = [];
            }

            if (count($results) > 1 && password_verify($_POST['password_aluno'], $results['senha']) == True){
                $_SESSION['user_id_aluno'] = $results["id_aluno"];
                $_SESSION['name'] = $results["nome"];
                $_SESSION['numero'] = $results["numero"];
                $_SESSION['email'] = $results["email"];
                $_SESSION['messageInformation'] = "";
                header("Location: ./userPages/studentPage.php");
            } else {
                $_SESSION["messageInformation"] = 'Credenciais incorretas!';
                $_SESSION['miColor'] = '#FA6E65';
            }
        }

        //Login Empresa
        if(!empty($_POST['cnpj']) && !empty($_POST['password_empresa'])){
            $query = "SELECT * FROM empresa WHERE cnpj = :cnpj";
            $records = $conn->prepare($query);
            $records->bindParam(':cnpj', $_POST['cnpj']);
            $records->execute();

            $results = $records->fetch(PDO::FETCH_ASSOC);

            if ($results == false){
                $results = [];
            }

            if (count($results) > 1 && password_verify($_POST['password_empresa'], $results['senha'])){
                $_SESSION['user_id_empresa'] = $results["id_empresa"];
                $_SESSION['name'] = $results["nome"];
                $_SESSION['messageInformation'] = "";
                header("Location: ./userPages/companyPage.php");
            } else {
                $_SESSION["messageInformation"] = 'Credenciais incorretas!';
                $_SESSION['miColor'] = '#FA6E65';
            }
            
        }


    
?>