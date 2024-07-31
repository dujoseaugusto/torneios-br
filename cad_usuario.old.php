<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/funcoes.js"></script>
<script type="text/javascript" src="js/maskedinput.js"></script>  
<script type="text/javascript" src="js/cidades_estados.js" charset="iso-8859-1"></script> 
<title>Cadastro</title>
</head>

<body>

<form name="CadastroUsuario" method="post" action="#" onsubmit="return validaCadastro();">
	<label>Nome:</label>&nbsp;<input type="text" name="nome" />
    <br /><br />
    <label>E-mail:</label>&nbsp;<input type="text" name="email" />
    <br /><br />
     <label>Estado:&nbsp;</label>
     	<select name="estado" id="estado">
			<option value="">Selecione um estado...</option>
        </select>
    <br /><br />
	<label>Cidade:&nbsp;</label>
    	<select name="cidade" id="cidade">
        	<option value="">Selecione uma cidade...</option>
         </select>
    <br /><br />
    <label>Clube:&nbsp;</label>
    	<select name="clube">
        	<option value="">Selecione um clube...</option>
        </select>
    <br /><br />
    <label>CPF:&nbsp;</label><input type="text" name="cpf" id="cpf" />
    <br /><br />
    <label>CTF:&nbsp;</label><input type="text" name="ctf" />
    <br /><br />
    <label>Senha:&nbsp;</label><input type="password" name="senha" />
    <br /><br />
    <input type="submit" value="Cadastrar" />
</form>

</body>
</html>