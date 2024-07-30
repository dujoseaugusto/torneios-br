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

<form name="CadastraTorneio" method="post" action="#" onsubmit="return validaCadTorneio();">
	<label>Nome da torneio:</label>&nbsp;<input type="text" name="nome" />
    <br /><br />
    <label>Local:</label>&nbsp;<input type="text" name="local" />
    <br /><br />
    <label>Etapa:&nbsp;</label>
    	<select name="temporada">
        	<option value="">Selecione uma etapa...</option>
         </select>
    <br /><br />
    <label>Modalidade:&nbsp;</label>
    	<select name="modalidade">
        	<option value="">Selecione uma modalidade...</option>
         </select>
    <br /><br />
    <label>Data da realização:</label>&nbsp;<input type="text" name="data" class="data" />
    <br /><br />
    <label>Data limite de inscrições:</label>&nbsp;<input type="text" name="data_limite" class="data" />
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
    <input type="submit" value="Cadastrar Torneio" />
</form>

</body>
</html>