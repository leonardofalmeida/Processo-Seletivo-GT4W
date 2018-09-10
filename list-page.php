<?php 

require_once 'Op/Select_User.php';

if (($result) AND ($result->rowCount() != 0) ) {
	?>

	<!---------- BOTÃO: Cadastro ---------->
	<div class="d-flex justify-content-center">
		<button class="btn btn-success" id="btn-create" style="width: 20%;" data-toggle="modal" data-target="#modal-cad">Cadastrar-se</button>
	</div>

	<!---------- MODAL: Cadastro ---------->
	<div class="modal fade" id="modal-cad" tabindex="-1" role="dialog" aria-labelledby="modal-cad" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" id="modal-cad-titulo">
					<h5 class="modal-title text-white" id="modal-title-cad">Casdatro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" action="Op/Create_User.php" method="post">
						<div class="control-group <?php echo !empty($nomeError)?'error':'';?>">
							<div class="form-group">
								<label for="nome" class="control-label">Nome</label>
								<input type="text" name="nome" class="form-control" id="recipient-nome" placeholder="Ex: João Antônio" required>
								<?php if (!empty($nomeError)): ?>
									<span class="help-inline"><?php echo $nomeError;?></span>
								<?php endif; ?>
							</div>
						</div>

						<div class="control-group <?php echo !empty($cpfError)?'error':'';?>">
							<div class="form-group">
								<label for="cpf" class="control-label">CPF</label>
								<input type="text" name="cpf" class="form-control" id="recipient-cpf" placeholder="Apenas números" maxlength="11" pattern="[0-9]+$" required>
								<?php if (!empty($cpfError)): ?>
									<span class="help-inline"><?php echo $cpfError;?></span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="nascimento" class="control-label">Data de Nascimento</label>
							<input type="date" name="nascimento" class="form-control" id="recipient-nascimento"  value="<?php echo !empty($nascimento)?$nascimento:'';?>">
						</div>

						<div class="form-group">
							<label for="peso" class="control-label">Peso (em kg)</label>
							<input type="text" name="peso" class="form-control" id="recipient-peso" placeholder="Ex: 74" value="<?php echo !empty($peso)?$peso:'';?>">
						</div>

						<div class="form-group">
							<label for="estado" class="control-label">Estado</label>
							<select id="recipient-estado-cad" class="form-control" name="estado">
							</select>
							<input type="hidden" name="id" id="id">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success">Cadastrar</button>
						</div>
					</form>
				</div> <!-- modal body -->
			</div> <!-- modal header -->
		</div> <!-- modal content -->
	</div> <!-- modal dialog -->
</div> <!-- modal -->

<!---------- Listagem dos usuários cadastrados ---------->
<div class="card" id="card-list">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover" id="form-list">
				<thead class="thead-dark">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nome</th>
						<th scope="col">CPF</th>
						<th scope="col">Nascimento</th>
						<th scope="col">Peso(kg)</th>
						<th scope="col">Estado</th>
						<th scope="col">Opções</th>
					</tr>
				</thead>
				<tbody>
					<!---------- Loop da lista ---------->
					<?php foreach ($result as $row){ ?>
						<tr>
							<td><?php echo $row['ID']; ?></td>
							<td><?php echo $row['nome']; ?></td>
							<td><?php echo $row['cpf']; ?></td>
							<td><?php echo $row['nascimento']; ?></td>
							<td><?php echo $row['peso']; ?></td>
							<td><?php echo $row['estado']; ?></td>
							<td width=250>

								<!---------- BOTÃO: Ver Usuário ---------->
								<button class="btn btn-info" data-toggle="modal" data-target="#modal-ver<?php echo $row['ID']; ?>">Ver</button>

								<!---------- BOTÃO: Editar Usuário ---------->
								<button class="btn btn-warning" data-toggle="modal" data-target="#modal-editar" data-whatever="<?php echo $row['ID']; ?>" data-whatevernome="<?php echo $row['nome']; ?>" data-whatevercpf="<?php echo $row['cpf']; ?>" data-whatevernascimento="<?php echo $row['nascimento']; ?>" data-whateverpeso="<?php echo $row['peso']; ?>" data-whateverestado="<?php echo $row['estado']; ?>">Editar</button>

								<!---------- BOTÃO: Excluir Usuário ---------->
								<button  class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete<?php echo $row['ID']; ?>">Excluir</button>
							</td>
						</tr>

						<!-- MODAL: Ver Usuário -->
						<div class="modal fade" id="modal-ver<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header" id="modal-ver-titulo">
										<h5 class="modal-title text-white text-center" id="exampleModalLongTitle">Informações pessoais</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<h6 class="card-text"><strong>Nome:</strong></h6>
										<p><?php echo $row['nome'];?></p>
										<h6 class="card-text"><strong>CPF:</strong></h6>
										<p><?php echo $row['cpf'];?></p>
										<h6 class="card-text"><strong>Data Nascimento:</strong></h6>
										<p><?php echo $row['nascimento'];?></p>
										<h6 class="card-text"><strong>Peso(kg):</strong></h6>
										<p><?php echo $row['peso'];?></p>
										<h6 class="card-text"><strong>Estado:</strong></h6>
										<p><?php echo $row['estado'];?></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>

						<!---------- MODAL: Excluir Cadastro ---------->
						<div class="modal fade" id="confirm-delete<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header" id="modal-deletar-titulo">
										<h5 class="modal-title text-white" id="exampleModalLabel">Confirmação</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body text-center">
										<h6>Deseja realmente excluir o registro <?php echo $row['nome']; ?> ?</h6>
									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-outline-success" data-dismiss="modal">NÃO</button>
										<a href="Op/Delete_User.php?id=<?php echo $row['ID']; ?>" class="btn btn-outline-danger">SIM</a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?> <!-- Fim do foreach -->
					</tbody>
				</table>
				<?php require 'pagination.php'; ?> <!-- Paginação da lista -->

				<!---------- MODAL: Editar Usuário ---------->
				<div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header" id="modal-edit-titulo">
								<h5 class="modal-title text-white" id="exampleModalLabel">Editar Cadastro</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="Op/Update_User.php">
									<div class="form-group">
										<label for="name" class="col-form-label">Nome</label>
										<input name="nome" type="text" class="form-control" id="recipient-nome" required="">
									</div>
									<div class="form-group">
										<label for="cpf" class="col-form-label">CPF</label>
										<input name="cpf" type="text" class="form-control" id="recipient-cpf" required="" maxlength="11" pattern="[0-9]+$"></input>
									</div>
									<div class="form-group">
										<label for="nascimento" class="col-form-label">Data Nascimento</label>
										<input name="nascimento" type="date" class="form-control" id="recipient-nascimento"></input>
									</div>
									<div class="form-group">
										<label for="peso" class="col-form-label">Peso</label>
										<input name="peso" type="text" class="form-control" id="recipient-peso"></input>
									</div>
									<div class="form-group">
										<label for="estado" class="col-form-label">Estado</label>
										<select name="estado" class="form-control" id="recipient-estado-upd">
										</select>
									</div>
									<input name="id" type="hidden" id="id-user">
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success">Atualizar</button>
									</div>
								</form>
							</div>
						</div> <!-- modal content -->
					</div> <!-- modal dialog -->
				</div> <!-- modal -->
			</div>
		</div> <!-- card body -->
	</div> <!-- card -->

	<!-- Else da verificação se há usuarios cadastrados -->
<?php 	
}
else{
	echo "<div class='alert alert-dark text-center' role='alert'> Nenhum usuário cadastrado!</div>";
?>	

<!---------- MODAL/BOTÃO: Editar Usuário caso não tenha nenhum registro no banco ---------->
<div class="d-flex justify-content-center">
	<button class="btn btn-success" id="btn-create" style="width: 20%;" data-toggle="modal" data-target="#modal-cad">Cadastrar-se</button>
</div>
<div class="modal fade" id="modal-cad" tabindex="-1" role="dialog" aria-labelledby="modal-cad" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" id="modal-cad-titulo">
					<h5 class="modal-title text-white" id="modal-title-cad">Cadastro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" action="Op/Create_User.php" method="post">
						<div class="control-group <?php echo !empty($nomeError)?'error':'';?>">
							<div class="form-group">
								<label for="nome" class="control-label">Nome</label>
								<input type="text" name="nome" class="form-control" id="recipient-nome" placeholder="Ex: João Antônio" required>
								<?php if (!empty($nomeError)): ?>
									<span class="help-inline"><?php echo $nomeError;?></span>
								<?php endif; ?>
							</div>
						</div>

						<div class="control-group <?php echo !empty($cpfError)?'error':'';?>">
							<div class="form-group">
								<label for="cpf" class="control-label">CPF</label>
								<input type="text" name="cpf" class="form-control" id="recipient-cpf" placeholder="Ex: 12345678912" maxlength="11" pattern="[0-9]+$" required>
								<?php if (!empty($cpfError)): ?>
									<span class="help-inline"><?php echo $cpfError;?></span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<label for="nascimento" class="control-label">Data de Nascimento</label>
							<input type="date" name="nascimento" class="form-control" id="recipient-nascimento"  value="<?php echo !empty($nascimento)?$nascimento:'';?>">
						</div>

						<div class="form-group">
							<label for="peso" class="control-label">Peso (em kg)</label>
							<input type="text" name="peso" class="form-control" id="recipient-peso" placeholder="Ex: 74" value="<?php echo !empty($peso)?$peso:'';?>">
						</div>

						<div class="form-group">
							<label for="estado" class="control-label">Estado</label>
							<select id="recipient-estado-cad" class="form-control" name="estado">
							</select>
							<input type="hidden" name="id" id="id">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success">Cadastrar</button>
						</div>
					</form>
				</div> <!-- modal body -->
			</div> <!-- modal header -->
		</div> <!-- modal content -->
	</div> <!-- modal dialog -->
</div> <!-- modal -->
<?php } ?>

<script>
	//---------- jQuery do modal editar usuário ---------\\
	$('#modal-editar').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget) // Botão que dispara o modal
	var recipient = button.data('whatever') // Extrai informação da data-(algumacoisa)
	var recipientnome = button.data('whatevernome')
	var recipientcpf = button.data('whatevercpf')
	var recipientnascimento = button.data('whatevernascimento')
	var recipientpeso = button.data('whateverpeso')
	var recipientestado = button.data('whateverestado')
	
	var modal = $(this)
	modal.find('.modal-title').text('Atualizar dados')
	modal.find('#id-user').val(recipient) //Armazena os valores dos inputs
	modal.find('#recipient-nome').val(recipientnome)
	modal.find('#recipient-cpf').val(recipientcpf)
	modal.find('#recipient-nascimento').val(recipientnascimento)
	modal.find('#recipient-peso').val(recipientpeso)
	modal.find('#recipient-estado-upd').val(recipientestado)
})

// -------- JSON Geonames ------- \\
$(document).ready(function () {

	var url = "http://www.geonames.org/childrenJSON?geonameId=3469034";

	$.getJSON(url, function (data) {
		for(i in data.geonames){

			$('#recipient-estado-cad').append('<option value="' + data.geonames[i].name + '">' + data.geonames[i].name + '</option>');
			$('#recipient-estado-upd').append('<option value="' + data.geonames[i].name + '">' + data.geonames[i].name + '</option>');
		}
	});
});
</script>
