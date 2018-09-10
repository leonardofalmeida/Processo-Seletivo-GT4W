<?php
session_start();
require 'database.php';


if ( !empty($_POST)) {
    
    //Reseta os erros
    $nomeError = null;
    $cpfError = null;

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $nascimento = $_POST['nascimento'];
    $peso = $_POST['peso'];
    $estado = $_POST['estado'];
    $msg = "";
    
    ////Valida as entradas obrigatórias
    $valid = true;
    if (empty($nome)) {
        $nameError = 'Por favor insira o seu nome.';
        $valid = false;
    }

    if (empty($cpf)) {
        $emailError = 'Por favor insira um CPF.';
        $valid = false;
    } 

    //Inseri se for válido
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (nome,cpf,nascimento,peso,estado) values(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome,$cpf,$nascimento,$peso,$estado));
        
        if($pdo->lastInsertId()){
            $_SESSION['msg'] = '<div class=" text-center alert alert-success alert-dismissible fade show" role="alert">Usuário cadastrado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            header("Location: ../index.php");
        }else{
            $_SESSION['msg'] = '<div class=" text-center alert alert-danger alert-dismissible fade show" role="alert">Erro ao cadastrar usuário. Tente novamente!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            header("Location: ../index.php");
        }
        Database::disconnect();
    }
}
?>