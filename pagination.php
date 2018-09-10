<?php

//--- Paginação - somar a quantidade de usuários ---\\
$sql = "SELECT COUNT(id) AS num_result FROM usuarios";  
$resultado_pg = $pdo->query($sql);
$row_pg = $resultado_pg->fetch(PDO::FETCH_ASSOC);

//--- Quantidade de páginas ---\\
$qnt_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

//Limitar a quantidade de links mostrados antes e depois Ex: 2 3 4 ---\\
$max_links = 1;

//--- Paginação com Bootstrap
echo'<nav aria-label="Page navigation example">';
echo'<ul class="pagination">';
echo"<li class='page-item'><a class='page-link' href='#' onclick='listarUsuario(1, $qnt_result_pg)'>Primeira</a></li>";

//--- Define a página anterior em relação a atual
//--- Lembrando que $pagina = 1 no começo
for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
	if($pag_ant >= 1){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuario($pag_ant, $qnt_result_pg)'> $pag_ant </a></li>"; //Página anterior
		}
	}
	echo"<li class='page-item active'><a class='page-link' href='#' onclick='listarUsuario($pagina, $qnt_result_pg)'> $pagina </a></li>"; //Página atual
	
	for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
		if($pag_dep <= $qnt_pg){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuario($pag_dep, $qnt_result_pg)'> $pag_dep </a></li>"; //Página depois
		}
	}
	echo "<a class='page-link' href='#' onclick='listarUsuario($qnt_pg, $qnt_result_pg)'>Ultima</a>";
	echo'</ul>';
	echo'</nav>';
?>