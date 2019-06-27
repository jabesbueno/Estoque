<?php
    include_once "../../classes/classeConexao.php";
    include_once "../../helpers/helper.php";
    include_once "../../dao/estoque/daoProduto.php";
    
    $busca = new DaoProduto();
    $select = $busca->buscaProduto();
    
    if(!isset($_SESSION['session_pesquisaProduto'])) $_SESSION['session_pesquisaProduto'] = '';
    if(!isset($_SESSION['session_listarProdutos'])) $_SESSION['session_listarProdutos'] = 'normal';
    
    $select2 = $busca->buscaProdutoESP($_SESSION['session_pesquisaProduto']);

    header('Content-type: text/html; charset=UTF-8');
    ?>
<HTML>
    <HEAD>
        <meta charset="UTF-8">
        <TITLE>Produto</TITLE>
    </HEAD>
    <BODY>
        <br>
        <div class="row">
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn_adicionar_produto" href="#" data-toggle="modal" data-target="#modalProduto">Adicionar Produto</button>
            </div>
            <form name="formPesquisa" id="formPesquisa" method="post" action="../../controllers/estoque/controllerProduto.php">
                <div class="col-sm-8">
                    <span class="pull-right">
                    <input type="text" class="form-control frm-pesquisa" id="Ds_Pesquisa" name="Ds_Pesquisa" style="text-transform:uppercase" maxlength="100" value="<?php echo $_SESSION['session_pesquisaProduto'] ?>" placeholder="PRODUTO">
                    </span>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-pesquisar-produto" name="botao" value="2">Pesquisar</button>
                </div>
            </form>
        </div>
        <br>
        <br>
        <!-- MODAL DE PRODUTO -->
        <div id="modalProduto" class="modal fade"  tabindex="-1" role="dialog" ref="formProduto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Produto</h3>
                    </div>
                    <form name="formProduto" id="formProduto" method="post" action="../../controllers/estoque/controllerProduto.php">
                        <div class="modal-body">
                            <input type="hidden" name="ID_Produto" />
                            <input type="hidden" name="acao" value="" />
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Nm_Produto">Nome</label>
                                    <input type="text" class="form-control frm-produto" id="Nm_Produto" name="Nm_Produto" maxlength="100" placeholder="CAFÉ">
                                    <?php if (isset($_SESSION['session_Nome'])) { ?>
                                    <script text/javascript> $('.frm-produto').attr('style', "border:#FF0000 1px solid;");</script>
                                    <?php echo '<div style="Color:red">' . nl2br($_SESSION['session_Nome']) . '</div>';                             
                                        } 
                                        ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Tp_Produto">Tipo</label>
                                    <select onchange="document.getElementById('Tp_Produto_Oculto').value=this.value; this.disabled=false;" id="Tp_Produto" name="Tp_Produto" class="form-control frm-tipo" required>
                                        <option value="ALIMENTO">ALIMENTO</option>
                                        <option value="HIGIENE">HIGIENE</option>
                                        <option value="QUÍMICO">QUÍMICO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="Dt_Entrada">Data de Entrada</label>
                                    <input type="date" class="form-control frm-data" id="Dt_Entrada" name="Dt_Entrada">
                                    <?php if (isset($_SESSION['session_Data'])) { ?>
                                    <script text/javascript> $('.frm-data').attr('style', "border:#FF0000 1px solid;");</script>
                                    <?php echo '<div style="Color:red">' . nl2br($_SESSION['session_Data']) . '</div>';                             
                                        } 
                                        ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="Nr_Quantidade">Quantidade</label>
                                    <input type="number" min="0" max="999999" maxlength = "6" class="form-control frm-quantidade" id="Nr_Quantidade" name="Nr_Quantidade">
                                    <?php if (isset($_SESSION['session_Quantidade'])) { ?>
                                    <script text/javascript> $('.frm-quantidade').attr('style', "border:#FF0000 1px solid;");</script>
                                    <?php echo '<div style="Color:red">' . nl2br($_SESSION['session_Quantidade']) . '</div>';                               
                                        } 
                                        ?>
                                </div>
                            </div>
                            <input type="hidden" name="Tp_Produto_Oculto" id="Tp_Produto_Oculto">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-inserir-produto" name="botao" value="1">Inserir</button>
                            <button type="reset" class="btn btn-secondary btn-limpar-produto">Limpar Campos</button>
                            <button type="button" class="btn btn-primary btn-fechar-produto" name="botao" value="0" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
		
		<!-- MODAL DE EXCLUSÃO PRODUTO -->
        <div id="modalExcluirProduto" class="modal fade"  tabindex="-1" role="dialog" ref="formExcluirProduto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Produto</h3>
                    </div>
                    <form name="formExcluirProduto" id="formExcluirProduto" method="post" action="../../controllers/estoque/controllerProduto.php">
                        <div class="modal-body">
                            <input type="hidden" name="ID_Produto" />
                            <input type="hidden" name="acao" value="" />
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control frm-produto" id="Nm_Produto" name="Nm_Produto" maxlength="100" placeholder="CAFÉ" disabled>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <h3 for="Nm_Produto">Você tem certeza que deseja excluir este produto?</label>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-excluir-produto" name="botao" value="3">SIM</button>
                            <button type="button" class="btn btn-primary btn-fechar-produto" name="botao" value="0" data-dismiss="modal">NÃO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
        <table class="table table-hover">
            <thead thead-default>
                <tr>
                    <th>Tipo</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Entrada em</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($_SESSION['session_listarProdutos'] == 'pesquisa') 
                    {
                        while($produto = $select2->fetch())
                        {  
                    ?>
                            <tr>
                                <td><?php echo utf8_encode($produto["Tp_Produto"]) ?></td>
                                <td><?php echo $produto["Nr_Codigo"] ?></td>
                                <td><?php echo utf8_encode($produto["Nm_Produto"]) ?></td>
                                <td><?php echo $produto["Nr_Quantidade"] ?></td>
                                <td><?php echo date("d/m/Y", strtotime($produto["Dt_Entrada"])); ?></td>
                                <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="editar_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-primary btn_editar_produto">Editar</a></td>
                                <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="excluir_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-danger btn_excluir_produto">Excluir</a></td>
                            </tr>
                    <?php 
                        }
                    
                        $_SESSION['session_listarProdutos'] = 'normal';
                        $_SESSION['session_pesquisaProduto'] = '';
                    }
                    else
                    { 
                        while($produto = $select->fetch())
                        { ?>
                            <tr>
                            <td><?php echo utf8_encode($produto["Tp_Produto"]) ?></td>
                            <td><?php echo $produto["Nr_Codigo"] ?></td>
                            <td><?php echo utf8_encode($produto["Nm_Produto"]) ?></td>
                            <td><?php echo $produto["Nr_Quantidade"] ?></td>
                            <td><?php echo date("d/m/Y", strtotime($produto["Dt_Entrada"])); ?></td>
                            <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="editar_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-primary btn_editar_produto">Editar</a></td>
                            <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="excluir_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-danger btn_excluir_produto">Excluir</a></td>
                        </tr>
                    <?php 
                        }
                    } ?>
            </tbody>
        </table>
        <!-- SCRIPT PARA EXIBIÇÃO DE ERROS DE VALIDAÇÃO/FORMATAÇÃO DE CAMPOS NO MODAL -->
        <?php 
            if(isset($_SESSION['session_modalProduto']) ? $_SESSION['session_modalProduto'] : null) { 
            ?>
        <script type="text/javascript">
            $(document).ready(function(){               
                if (performance.navigation.type != 1) {
                <?php if($_SESSION['session_acaoProduto'] == 'editar') { ?> 
                    document.getElementById('editar_produto_<?php echo $_SESSION['session_ID_Produto']?>').click();         
                <?php } else if($_SESSION['session_acaoProduto'] == 'adicionar') { ?>
                    $(".btn_adicionar_produto").click();
                <?php } ?>
                }
                else
                {
                    <?php
                $_SESSION['session_ID_Produto'] = null;
                $_SESSION['session_Nome'] = null;
                $_SESSION['session_Data'] = null;
                $_SESSION['session_Quantidade'] = null;
                $_SESSION['session_modalProduto'] = null;
                $_SESSION['session_acaoProduto'] = null;
                ?>
                }
            });
        </script>
        <?php } ?>
        <!-- FIM DO SCRIPT -->
    </BODY>
</HTML>