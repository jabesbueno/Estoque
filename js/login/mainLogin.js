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
	
	// Liberar o usuario ao adicionar
	$('.btn_adicionar_usuario').click(function()
	{
		$('#formUsuario input[name="acao"]').val('adicionar');
	});
});
	
