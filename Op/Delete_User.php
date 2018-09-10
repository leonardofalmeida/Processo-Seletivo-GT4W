<?php
session_start();
require 'database.php';

$id = $_GET['id'];

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM usuarios WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
if($q->rowCount()){
    $_SESSION['msg'] = '<div class=" text-center alert alert-success alert-dismissible fade show" role="alert">Usuário excluído com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    header("Location: ../index.php");
}else{
    $_SESSION['msg'] = '<div class=" text-center alert alert-danger alert-dismissible fade show" role="alert">Erro ao excluir usuário. Tente novamente!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    header("Location: ../index.php");
}
Database::disconnect();

?>