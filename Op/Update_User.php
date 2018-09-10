<?php

require_once 'database.php';
session_start();

//Reseta os erros
$nomeError = null;
$cpfError = null;

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$peso = $_POST['peso'];
$estado = $_POST['estado'];
 
//Valida as entradas obrigatórias
$valid = true;
if (empty($nome)) {
    $nameError = 'Por favor insira o seu nome.';
    $valid = false;
}

if (empty($cpf)) {
    $emailError = 'Por favor insira um CPF.';
    $valid = false;
} 

//Atualiza o banco, caso esteja tudo certo
if ($valid) {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE usuarios SET nome = ?, cpf = ?, nascimento = ?, peso = ?, estado = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nome,$cpf,$nascimento,$peso,$estado,$id));
    if($q->rowCount()){
            $_SESSION['msg'] = '<div class=" text-center alert alert-success alert-dismissible fade show" role="alert">Usuário atualizado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            header("Location: ../index.php");
        }else{
            $_SESSION['msg'] = '<div class=" text-center alert alert-danger alert-dismissible fade show" role="alert">Erro ao editar usuário. Tente novamente!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            header("Location: ../index.php");
        }
    Database::disconnect();
    header("Location: ../index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM usuarios where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $cpf = $data['cpf'];
    $nascimento = $data['nascimento'];
    $peso = $data['peso'];
    $estado = $data['estado'];
    Database::disconnect();
}
?>
