<?php

//  Configura��es do Script
// ==============================
$_SG['conectaServidor']     = true;    // Abre uma conex�o com o servidor MySQL?
$_SG['abreSessao']          = true;         // Inicia a sess�o com um session_start()?
$_SG['caseSensitive']       = false;     // Usar case-sensitive? Onde 'teste' � diferente de 'TESTE'
$_SG['validaSempre']        = true;       // Deseja validar o usu�rio e a senha a cada carregamento de p�gina?
// Evita que, ao mudar os dados do usu�rio no banco de dado o mesmo contiue logado.

$_SG['servidor']            = 'localhost';    // Servidor MySQL
$_SG['usuario']             = 'arpagc45_user1';       // Usu�rio MySQL
$_SG['senha']               = '1975592';    // Senha MySQL
$_SG['banco']               = 'arpagc45_arpag';

$_SG['paginaLogin'] = 'index.php'; // P�gina de login

$_SG['tabela'] = 'arpag_pessoa';       // Nome da tabela onde os usu�rios s�o salvos
// ==============================
// ======================================
//   ~ N�o edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conex�o com o MySQL
if ($_SG['conectaServidor'] == true) {
$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: N�o foi poss�vel conectar-se ao servidor [".$_SG['servidor']."].");
mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: N�o foi poss�vel conectar-se ao banco de dados [".$_SG['banco']."].");
}


?>