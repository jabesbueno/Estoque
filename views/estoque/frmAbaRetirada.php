<?php
    include_once "../../classes/classeConexao.php";
    include_once "../../helpers/helper.php";
    include_once "../../dao/estoque/daoRetirada.php";
    include_once "../../dao/estoque/daoProduto.php";
    
    $busca = new DaoRetirada();
    $select = $busca->buscaRetirada();
    
    if(!isset($_SESSION['session_pesquisaRetirada'])) $_SESSION['session_pesquisaRetirada'] = '';
    if(!isset($_SESSION['session_listarRetiradas'])) $_SESSION['session_listarRetiradas'] = 'normal';
    
    $select2 = $busca->buscaRetiradaESP($_SESSION['session_pesquisaRetirada']);
    
    $busca_produto = new DaoProduto();
    $select_produto = $busca_produto->BuscaProduto();
    ?>
<HTML>
    <HEAD>
        <TITLE>Retirada</TITLE>
        <meta charset="utf-8">
    </HEAD>
    <BODY>
        <div class="row">
            <br>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn_adicionar_retirada" href="#" data-toggle="modal" data-target="#modalRetirada">Adicionar Retirada</button>
            </div>
            <form name="formPesquisa" id="formPesquisa" method="post" action="../../controllers/estoque/controllerRetirada.php">
                <div class="col-sm-8">
                    <span class="pull-right">
                    <input type="text" class="form-control frm-pesquisa" id="Ds_Pesquisa" name="Ds_Pesquisa" style="text-transform:uppercase" maxlength="100" value="<?php echo $_SESSION['session_pesquisaRetirada'] ?>" placeholder="PRODUTO">
                    </span>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-pesquisar-retirada" name="botao" value="2">Pesquisar</button>
                </div>
            </form>
        </div>
        <br>
        <br>
        <!-- MODAL DE PRODUTO -->
        <div id="modalRetirada" class="modal fade"  tabindex="-1" role="dialog" ref="formRetirada">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Retirada</h3>
                    </div>
                    <form name="formRetirada" id="formRetirada" method="post" action="../../controllers/estoque/controllerRetirada.php">
                        <div class="modal-body">
                            <input type="hidden" name="ID_Retirada"/>
                            <input type="hidden" name="ID_ProdutoR"/>
                            <input type="hidden" name="acao" value=""/>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Nm_ProdutoR">Produto</label>
                                    <select onchange="document.getElementById('Nm_ProdutoR_Oculto').value=this.value; this.disabled=false;" id="Nm_ProdutoR" name="Nm_ProdutoR" class="form-control frm-nome-retirada" required>
                                        <?php while($retirada = $select_produto->fetch()) {  ?>                     
                                        <option value = "<?php echo utf8_encode($retirada["Nm_Produto"]) ?>"><?php echo utf8_encode($retirada["Nm_Produto"]) ?></option>
                                        <?php } ?>      
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Nm_Responsavel">Retirado por</label>
                                    <input type="text" class="form-control frm-responsavel" id="Nm_Responsavel" name="Nm_Responsavel" style="text-transform:uppercase" maxlength="100" placeholder="JABES">
                                    <?php if (isset($_SESSION['session_Nm_Responsavel'])) { ?>
                                    <script text/javascript> $('.frm-responsavel').attr('style', "border:#FF0000 1px solid;");</script>
                                    <?php echo '<div style="Color:red">' . nl2br($_SESSION['session_Nm_Responsavel']) . '</div>';           
                                        } 
                                        ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Dt_Retirada">Data de Retirada</label>
                                    <input type="date" class="form-control frm-data-retirada" id="Dt_Retirada" name="Dt_Retirada">
                                    <?php if (isset($_SESSION['session_Dt_Retirada'])) { ?>
                                    <script text/javascript> $('.frm-data-retirada').attr('style', "border:#FF0000 1px solid;");</script>
                                    <?php echo '<div style="Color:red">' . nl2br($_SESSION['session_Dt_Retirada']) . '</div>'; 
                                        } 
                                        ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="Nr_QuantProd">Quantidade Retirada</label>
                                    <input type="number" min="0" max="999999" maxlength = "6" class="form-control frm-quant-prod" id="Nr_QuantProd" name="Nr_QuantProd">
                                    <?php 
                                        if (isset($_SESSION['session_Nr_QuantProd'])) { ?>
                                    <script text/javascript> $('.frm-quant-prod').attr('style', "border:#FF0000 1px solid;");</script>
                                    <?php echo '<div style="Color:red">' . nl2br($_SESSION['session_Nr_QuantProd']) . '</div>';             
                                        } 
                                        ?>
                                </div>
                            </div>
                            <input type="hidden" name="Nm_ProdutoR_Oculto" id="Nm_ProdutoR_Oculto">
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
        <table class="table table-hover">
            <thead thead-default>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Retirado por</th>
                    <th>Quantidade</th>
                    <th>Retirado em</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($_SESSION['session_listarRetiradas'] == 'pesquisa') 
                        {
                            while($retirada = $select2->fetch())
                            { ?>
                                <tr>
                                    <?php 
                                    $cor = '#000000';
                                    if($busca->retornarDataEntrada($retirada["ID_ProdutoR"]) > $retirada["Dt_Retirada"]) $cor = '#696969'; 
                                    ?>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . $retirada["ID_Retirada"] . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . utf8_encode($busca->retornarNomeProduto($retirada["ID_ProdutoR"])) . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . $retirada["Nm_Responsavel"] . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . $retirada["Nr_QuantProd"] . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . date("d/m/Y", strtotime($retirada["Dt_Retirada"])) . '</span>' ?></td>
                                    <td><a href="#retirada" data='<?php echo json_encode(array_map("utf8_encode", $retirada)) ?>' id="editar_retirada_<?php echo $retirada["ID_Retirada"]?>" class="btn btn-primary btn_editar_retirada <?php if($busca->retornarDataEntrada($retirada["ID_ProdutoR"]) > $retirada["Dt_Retirada"]) { ?> btn-secondary disabled <?php } ?>">Editar</a></td>
                                </tr>
                      <?php }

                            $_SESSION['session_listarRetiradas'] = 'normal';
                            $_SESSION['session_pesquisaRetirada'] = '';
                        }
                        else
                        {
                            while($retirada = $select->fetch()) 
                            { ?>
                                <tr>
                                    <?php 
                                    $cor = '#000000';
                                    if($busca->retornarDataEntrada($retirada["ID_ProdutoR"]) > $retirada["Dt_Retirada"]) $cor = '#696969'; 
                                    ?>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . $retirada["ID_Retirada"] . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . utf8_encode($busca->retornarNomeProduto($retirada["ID_ProdutoR"])) . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . $retirada["Nm_Responsavel"] . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . $retirada["Nr_QuantProd"] . '</span>' ?></td>
                                    <td><?php echo '<span style="color:' . $cor . ';text-align:center;">' . date("d/m/Y", strtotime($retirada["Dt_Retirada"])) . '</span>' ?></td>
                                    <td><a href="#retirada" data='<?php echo json_encode(array_map("utf8_encode", $retirada)) ?>' id="editar_retirada_<?php echo $retirada["ID_Retirada"]?>" class="btn btn-primary btn_editar_retirada <?php if($busca->retornarDataEntrada($retirada["ID_ProdutoR"]) > $retirada["Dt_Retirada"]) { ?> btn-secondary disabled <?php } ?>">Editar</a></td>
                                </tr>
                <?php   }
                    } ?>
            </tbody>
        </table>
        <!-- SCRIPT PARA EXIBIÇÃO DE ERROS DE VALIDAÇÃO/FORMATAÇÃO DE CAMPOS NO MODAL -->
        <?php if(isset($_SESSION['session_modalRetirada']) ? $_SESSION['session_modalRetirada'] : null) { ?>
        <script type="text/javascript">
            $(document).ready(function(){               
                if (performance.navigation.type != 1) {
                    <?php if($_SESSION['session_acaoRetirada'] == 'editar') { ?> 
                        document.getElementById('editar_retirada_<?php echo $_SESSION['session_ID_Retirada']?>').click();           
                    <?php } else if($_SESSION['session_acaoRetirada'] == 'adicionar') { ?>
                        $(".btn_adicionar_retirada").click();
                    <?php } ?>
                }
                else
                {
                    <?php
                $_SESSION['session_ID_Retirada'] = null;
                $_SESSION['session_Nm_Responsavel'] = null;
                $_SESSION['session_Dt_Retirada'] = null;
                $_SESSION['session_Nr_QuantProd'] = null;
                $_SESSION['session_acaoRetirada'] = null;
                $_SESSION['session_modalRetirada'] = null;
                ?>
                }
            });
        </script>
        <?php } ?>
        <!-- FIM DO SCRIPT -->
    </BODY>
</HTML>