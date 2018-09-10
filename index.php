<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
	<div class="container">
		<div class="row d-flex justify-content-center" id="titulo-principal">
			<h3>Sistema de Gestão de Usuários</h3>
		</div>
		<div class="container">
			<h6>
				<?php 
				if(isset($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
				?>
			</h6>
		</div>

		<!-- list-page.php -->
		<span id="form"></span>

	</div> <!-- div container -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="jquery.maskedinput.js" type="text/javascript"></script>
	<script src="js/script.js"></script>
	
</body>
</html>