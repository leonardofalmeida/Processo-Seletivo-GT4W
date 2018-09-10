<?php 

require_once 'database.php';

$row = "";
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qntResultPg', FILTER_SANITIZE_NUMBER_INT);

//Define qual será o primeiro registro de cada página
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT * FROM usuarios ORDER BY nome ASC LIMIT '.$inicio.', '. $qnt_result_pg;
$result = $pdo->query($sql);
?>