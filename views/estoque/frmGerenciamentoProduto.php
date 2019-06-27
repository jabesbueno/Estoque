<?php
    ini_set('default_charset','UTF-8'); 
    
    session_start();
?>
<HTML>
    <HEAD>
        <meta charset="UTF-8">
        <TITLE>Estoque</TITLE>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../js/javascripts-estoque.php"></script>
    </HEAD>
    <BODY>
        <div id="headerwrap" style="background-color: #FEFEFE;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class=""></span>
                            <span class=""></span>
                            <span class=""></span>
                            </button>
                           <!-- <a class="navbar-brand" href="../frmTelaPrincipal.php">ESTOQUE</a> -->
                        </div>
                        <div class="navbar-collapse collapse navbar-right">
                            <ul class="nav navbar-nav">
                                <li><a href="../frmTelaPrincipal.php">Menu Principal</a></li>
                                <li><a href="../frmTelaLogin.php">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Nav tabs -->
                    <div class="col-md-12">  
                        <ul class="nav nav-tabs" role="tablist" id="tabs_navegacao_estoque">
                            <li role="presentation"><a href="#inicio" aria-controls="home" class="btn btn-light" role="tab" data-toggle="tab">Início</a></li>
                            <li role="presentation"><a href="#produto" class="btn btn-light" role="tab" data-toggle="tab">Produto</a></li>
                            <li role="presentation"><a href="#retirada" class="btn btn-light" role="tab" data-toggle="tab">Retirada</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="inicio" class="tab-pane fade">
                                <h3>Inicio</h3>
                                <p><h4>Sistema de Gerenciamento de Estoque...</h4></p><br>
								<p><h4>Acesso as abas produtos para realizar a movimentação do estoque</h4></p>
                            </div>
                            <div class="tab-pane" id="produto" class="tab-pane fade">
                                <?php include_once 'frmAbaProduto.php'?>
                            </div>
                            <div class="tab-pane" id="retirada" class="tab-pane fade">
                                <?php include_once 'frmAbaRetirada.php'?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /headerwrap -->
    </BODY>
</HTML>