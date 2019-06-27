<?php

ini_set('default_charset','UTF-8'); 
session_start();
?>
<HTML>
    <HEAD>
		<TITLE>Menu Principal</TITLE>
        <meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </HEAD>
    <BODY style="background-color:#F5F5F5;">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand">ESTOQUE</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a class="nav-link" href="estoque/frmGerenciamentoProduto.php#inicio">Gerenciamento de Estoque</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true aria-expanded="false">
						Usuário: <?php echo $_SESSION['session_Logado']?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="nav-link dropdown-toggle" href="frmTelaLogin.php">Sair</a>
						</div>
					</li>
				</ul>
				<!--<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Usuário: </a>
					</li>
				</ul>-->

			</div>
		</nav>
		<br><br><br>
		<div class="text-center">
 			<img src="estoque.png" class="rounded mx-auto d-block">
		</div>

    </BODY>
</HTML>