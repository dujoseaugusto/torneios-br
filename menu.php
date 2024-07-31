
<div style="float: left; margin-left: 2%; min-width: 100px;">
        <form name="pesq" action="pesquisa.php" method="post">
        <table>
        <tr><td><div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"  ></i></span>
        <input type="text" name="pesquisa" style="width: 200px;" class="form-control" placeholder="Nome da Ave ou Proprietário" required />
        </div>
        </td>
        <td><div class="form-group input-group">
        <input type="submit" id="Entrar" class="btn btn-primary" value="Pesquisar" />
        </div></td></tr>
        </table>
        </form>
</div>
<div style="float: right; text-align: right; margin-right: 2%;  min-width: 100px;">
<?php
if (isset($_SESSION['usuarioNome'])){
         echo utf8_encode($_SESSION['usuarioNome']);
         ?>
            <div style="font-weight:bold;">
            <a href='cad_usuarioregistrado.php'>Meus dados</a>  | 
            <a href='cad_passaro.php'>Meus Pássaros</a> | 
            <a href='cad_inscricoes.php'>Inscrição</a> | 
            <a href='close.php'>Sair</a>
        </div>
		<?php
}
else{
		?> 
        <form name="login" action="valida.php" method="post">
						<table>
                         <tr><td><div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="cpf" name="usuario" class="form-control" placeholder="Digite o cpf sem ponto" autofocus="autofocus" required />
                                    </div>
                        </td>
                        <td><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                            <input type="password" name="senha" class="form-control" placeholder="Digite a Senha" required />
                            </div>
                        </td>
                        <td>
                        <div class="form-group input-group">
                        <input type="submit" name="logar" id="Entrar" class="btn btn-primary" value="Entrar" />
                        </div>
                        </td></tr>             
                        </table>                        
                         	<a href="esenha.php">Esqueci </a> | 
        					<a href='cad_usuario.php'>Cadastre-se</a>
                         
                </form>
        
		<?php
}
?>
</div>
