<?php
ini_set('default_charset','UTF-8'); 

session_start();

	if(!isset($_SESSION['session_validaLogin'])) $_SESSION['session_validaLogin'] = '';
	if(!isset($_SESSION['session_validarUsuario'])) $_SESSION['session_validarUsuario'] = '';
	if(!isset($_SESSION['session_validarSenha'])) $_SESSION['session_validarSenha'] = '';
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="estoque.png">-->

    <title>Gestão de Estoque</title>
	<link rel="stylesheet" href="css/bootstrap2.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/javascripts-login.php"></script>
  </head>

  <body>
	<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">ESTOQUE</a>
				</div>
					<ul class="nav navbar-nav">
						<li class="active"><a id="btn_adicionar_usuario" name="btn_adicionar_usuario" class="btn btn-primary btn_adicionar_usuario" href="#" data-toggle="modal" data-target="#modalUsuario">Cadastrar-se</a></li>
					</ul>
			</div>
		</nav>
		<!-- MODAL DE USUARIO -->
        <div id="modalUsuario" class="modal fade"  tabindex="-1" role="dialog" ref="formUsuario">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Usuário</h3>
                    </div>
                    <form name="formUsuario" id="formUsuario" method="post" action="../controllers/estoque/controllerUsuario.php">
                        <input type="hidden" name="ID_Usuario" />
                        <input type="hidden" name="acao" value="" />
						<div class="modal-body">
							<?php if (isset($_SESSION['session_validaSenha'])) { 
								echo '<div style="Color:red">' . nl2br($_SESSION['session_validaSenha']) . '</div>';                             
							} 
							?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Nm_Usuario">Nome</label>
                                    <input type="text" class="form-control frm-usuario" id="Nm_Usuario" name="Nm_Usuario" maxlength="30" placeholder="Seu Nome">
									<?php if (isset($_SESSION['session_Usuario'])) { 
										echo '<div style="Color:red">' . nl2br($_SESSION['session_Usuario']) . '</div>';                             
                                        } 
                                    ?>
                                </div>
							</div>
							<div class="row">
                                <div class="col-md-4">
                                    <label for="Ds_Senha">Senha</label>
                                    <input type="password" class="form-control frm-usuario" id="Ds_Senha" name="Ds_Senha" maxlength="30" placeholder="*****">
									<?php if (isset($_SESSION['session_Senha'])) { 
										echo '<div style="Color:red">' . nl2br($_SESSION['session_Senha']) . '</div>';                             
                                        } 
                                    ?>
                                </div>
								<div class="col-md-4">
                                    <label for="confirmar">Confirmar Senha</label>
                                    <input type="password" class="form-control frm-usuario" id="confirmar" name="confirmar" maxlength="30" placeholder="*****">
									<?php if (isset($_SESSION['session_Confirmar'])) { 
										echo '<div style="Color:red">' . nl2br($_SESSION['session_Confirmar']) . '</div>';                             
                                        } 
                                    ?>
                                </div>
								<div class="col-md-4">
                                    <label for="Nr_Cpf">CPF</label>
                                    <input type="text" class="form-control frm-usuario" id="Nr_Cpf" name="Nr_Cpf" maxlength="30" placeholder="123.456.789.01">
									<?php if (isset($_SESSION['session_Cpf'])) {
										echo '<div style="Color:red">' . nl2br($_SESSION['session_Cpf']) . '</div>';   										
                                        }
                                    ?>
                                </div>
							</div>
                        </div>
                           
						<div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-inserir-usuario" name="botao" value="1">Inserir</button>
                            <button type="reset" class="btn btn-secondary btn-limpar-usuario">Limpar Campos</button>
                            <button type="button" class="btn btn-primary btn-fechar-usuario" name="botao" value="0" data-dismiss="modal">Fechar</button>
                        </div>
						
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
	<!-- SCRIPT PARA EXIBIÇÃO DE ERROS DE VALIDAÇÃO/FORMATAÇÃO DE CAMPOS NO MODAL -->
        <?php 
            if(isset($_SESSION['session_modalUsuario']) ? $_SESSION['session_modalUsuario'] : null) { 
            ?>
				<script type="text/javascript">
					$(document).ready(function(){
						if (performance.navigation.type != 1) {
						<?php  if($_SESSION['session_acaoUsuario'] == 'adicionar') { ?>
							$(".btn_adicionar_usuario").click();
						<?php } ?>
						}
						else
						{
							<?php
								$_SESSION['session_ID_Usuario'] = null;
								$_SESSION['session_Usuario'] = null;
								$_SESSION['session_Senha'] = null;
								$_SESSION['session_Confirmar'] = null;
								$_SESSION['session_Cpf'] = null;
								$_SESSION['session_modalUsuario'] = null;
								$_SESSION['session_validaSenha'] = null;
								$_SESSION['session_acaoUsuario'] = null;
								
								$_SESSION['session_validaLogin'] = null;
								$_SESSION['session_validarUsuario'] = null;
						        $_SESSION['session_validarSenha'] = null;
							?>
						}
					});
        </script>
        <?php } ?>
        <!-- FIM DO SCRIPT -->
		<form class="formLogin" id="formLogin" method="post" action="../controllers/estoque/controllerUsuario.php">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center mb-4">
						<img class="mb-4" src="estoque.png" alt="" width="72" height="72">
						<h1 class="h3 mb-3 font-weight-normal">Gestão de Estoque</h1>
						<p>Uma bom gerenciamento de estoque é o primeiro passo para o sucesso da sua empresa!</p>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-offset">
					<div class="col-md-4 ">
						<?php echo '<div style="Color:red">' . nl2br($_SESSION['session_validaLogin']) . '</div>'?>                            
						<label for="Nm_Usuario">Nome do Usuario</label>
						<input type="user" id="Nm_Usuario" name="Nm_Usuario" class="form-control" placeholder="Usuário">
						<?php echo '<div style="Color:red">' . nl2br($_SESSION['session_validarUsuario']) . '</div>'?>
					</div>
				</div>
				<div class="col-md-4">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-offset">
					<div class="col-md-4">
						<label for="Ds_Senha">Senha</label>
						<input type="password" id="Ds_Senha" name="Ds_Senha" class="form-control" placeholder="******">
						<?php echo '<div style="Color:red">' . nl2br($_SESSION['session_validarSenha']) . '</div>'?>
					</div>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		
			<!-- <div class="checkbox mb-3">
				<label>
				<input type="checkbox" value="lembrar de mim"> Lembrar de mim
				</label>
			</div> -->
			<br>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<button  type="submit" class="btn btn-lg btn-primary btn-block" name="botao" value="2">Entrar</button>
					<p class="mt-5 mb-3 text-muted text-center">Desenvolvido por Jabes Bueno do Livramento e Guilherme Antonio Ferrari</p>
				</div>
				<div class="col-md-4">
				</div>
			</div>
			
		</form>
		
  </body>
</html>
