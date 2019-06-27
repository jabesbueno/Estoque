$(document).ready(function()
{	
    // Limpar o form quando o usuário fechar o modal
    $('.modal').on('hidden.bs.modal', function()
	{
       $('#' + $(this).attr('ref')).trigger('reset');
       $('#' + $(this).attr('ref') + ' input[name="ID_Produto"]').val('');
       $('#' + $(this).attr('ref') + ' input[name="acao"]').val('');

       location.reload();
	});
	
	// Fechar o alerta automaticamente
	$(".alert").fadeTo(2000, 500).fadeOut(750, function()
	{
        $(".alert").alert('close');
    });

	// Validar campos numéricos
    document.getElementById('Nr_Quantidade').onkeydown = function(e) {
    	if(!((e.keyCode > 95 && e.keyCode < 106)
      	|| (e.keyCode > 47 && e.keyCode < 58) 
      	|| e.keyCode == 8)) {
        	return false;
    	}
	}
	document.getElementById('Nr_QuantProd').onkeydown = function(e) {
    	if(!((e.keyCode > 95 && e.keyCode < 106)
      	|| (e.keyCode > 47 && e.keyCode < 58) 
      	|| e.keyCode == 8)) {
        	return false;
    	}
	}

	// Limitar tamanho de casas no campo de quantidade
    Nr_Quantidade.oninput = function () {
    	if (this.value.length > 6) {
        	this.value = this.value.slice(0,6); 
    	}
	}

	// Limitar tamanho de casas no campo de quantidade
	Nr_QuantProd.oninput = function () {
    	if (this.value.length > 6) {
        	this.value = this.value.slice(0,6); 
    	}
	}

	// Carregar os dados do Produto no modal para editar
    $('.btn_editar_produto').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#formProduto input[name="ID_Produto"').val(dados.ID_Produto);
        $('#formProduto input[name="Nm_Produto"]').val(dados.Nm_Produto);
        $("#Nm_Produto").attr("readonly", true);
        $('#formProduto select[name="Tp_Produto"]').val(dados.Tp_Produto).change();
		$("#Tp_Produto").attr("disabled", true);
        $('#formProduto input[name="Dt_Entrada"]').val(dados.Dt_Entrada);
        $('#formProduto input[name="Nr_Quantidade"]').val(dados.Nr_Quantidade);
        $('#formProduto input[name="acao"]').val('editar');
		
        $('#modalProduto').modal();

        $('.btn-limpar-produto').hide();
	});
	
	$('.btn_excluir_produto').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#formExcluirProduto input[name="ID_Produto"').val(dados.ID_Produto);
        $('#formExcluirProduto input[name="Nm_Produto"]').val(dados.Nm_Produto);
		
        $('#modalExcluirProduto').modal();

        $('.btn-limpar-produto').hide();
	});
	
	// Liberar o tipo produto ao adicionar
	$('.btn_adicionar_produto').click(function()
	{
		$("#Nm_Produto").attr("readonly", false);
		$("#Tp_Produto").attr("disabled", false);

		$('#formProduto input[name="acao"]').val('adicionar');
	});
	
	// Liberar o usuario ao adicionar
	$('.btn_adicionar_usuario').click(function()
	{
		alert("poha");
		
		$('#formUsuario input[name="acao"]').val('adicionar');
	});

	// Carregar os dados da Retirada no modal para editar
	$('.btn_editar_retirada').click(function()
	{
            var dados = $.parseJSON($(this).attr('data'));
        
        	$('#formRetirada input[name="ID_Retirada"]').val(dados.ID_Retirada);
			$('#formRetirada input[name="Nm_Responsavel"]').val(dados.Nm_Responsavel);
        	$('#formRetirada select[name="Nm_ProdutoR"]').val(dados.Nm_ProdutoR).change();
        	$("#Nm_ProdutoR").attr("disabled", true);
        	$('#formRetirada input[name="Dt_Retirada"]').val(dados.Dt_Retirada);
        	$("#Dt_Retirada").attr("readonly", true);
        	$('#formRetirada input[name="Nr_QuantProd"]').val(dados.Nr_QuantProd);
        	$('#formRetirada input[name="acao"]').val('editar');
		
       		$('#modalRetirada').modal();
       		
        	$('.btn-limpar-produto').hide();
	});

	// Liberar o nome do Produto e Data de Retirada ao adicionar
	$('.btn_adicionar_retirada').click(function()
	{
		$("#Nm_ProdutoR").attr("disabled", false);
		$("#Dt_Retirada").attr("readonly", false);

		$('#formRetirada input[name="acao"]').val('adicionar');
	});
	
	// Carregar ref da página ao trocar de tab
	$('#tabs_navegacao_estoque a').click(function(e) 
	{
		e.preventDefault();
		$(this).tab('show');
	});
	
	// Armazenar aba/tab seleciona/aberta
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) 
	{			
		var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});

	// Restaurar aba aberta após recarregar a página
	var hash = window.location.hash;
	$('#tabs_navegacao_estoque a[href="' + hash + '"]').tab('show');
});
	
