var qntResultPg = 5;
var pagina = 1;

//--- Paginação ---\\
$(document).ready(function(){
	listarUsuario(pagina, qntResultPg);
});

function listarUsuario(pagina, qntResultPg){
	var dados = {
		pagina: pagina,
		qntResultPg: qntResultPg
	}

	$.post('list-page.php', dados, function(retorna){
		$('#form').html(retorna);
	});
}


//--- Efeito Lista ---\\
$(document).ready(function(){
	$('#form').hide();
	$('#form').delay('150');
	$('#form').fadeIn("slow")
});

$(document).ready(function(){
var cnpjcpf= $("#recipient-cpf-cad").val().length;
 
    if(cnpjcpf < 11){
        $("#recipient-cpf-cad").mask("999.999.999-99");
    } else {
        $("#recipient-cpf-cad").mask("99.999.999/9999-99");
    }    
});


