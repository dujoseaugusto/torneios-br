<?php
    include("seguranca/seguranca.php");
    //protegePagina(2);
    require_once('php/class.php');
    require_once('bd_funcao/maysql.php');
    require_once('php/funcao_0.2.php');
  
       if($id_pagamento = (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
            $consulta = new consulta();
                    $consulta->campo    = 'boleto';
                    $consulta->tabela   = "arpag_pagamento";
                    $consulta->parametro= "id = ".$id_pagamento;
                    $executa = select_db($consulta);
                    $linha = $executa->fetch_array();
            ?><input type="button" name="imprimir" value="Imprimir Boleto" onclick="window.print();"> 
                <a style="text-decoration: none;" href="cad_inscricoes.php"><input type="button" name="Voltar" value="Voltar para inscri&ccedil;&atilde;o" onclick="window.open(cad_inscricoes.php);"></a> 
                <a style="text-decoration: none;" href="pos_inscricao.php?m=<?php echo cript($id_pagamento);?>"><input type="button" name="Voltar" value="Imprimir ficha de inscri&ccedil;&atilde;o" onclick="window.open(pos_inscricao.php?m=<?php echo cript($id_pagamento);?>);"></a>
            <?php
            if(!$linha['boleto']){
                echo "<script> carrega(); window.location='pagamento2.php?kj=".cript($id_pagamento)."';</script>"; 
                echo " <meta http-equiv='refresh' content=1;url='pagamento2.php?kj=".cript($id_pagamento)."'>";
            }
            $boleto = str_replace('-->', '',str_replace('<!--', 'table {font-size:11px !important;}', $linha['boleto']));
            $boleto = str_replace('font-size:11px;', 'font-size:10px', $boleto);
            $boleto = str_replace('font-size:12px;', 'font-size:12px', $boleto);
            $boleto = str_replace('font-size:18px;', 'font-size:12px', $boleto);
            $boleto = str_replace(' height="93"', '', $boleto);
            $boleto = str_replace('height="40"', '', $boleto);
            $boleto = str_replace('height="42"', '', $boleto);
            $boleto = str_replace("height='72'", "", $boleto);
            echo $boleto;
        }