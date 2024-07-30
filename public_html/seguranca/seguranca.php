<?php session_start();
session_cache_expire(180);
//  Configurações do Script
// ==============================
$_SG['conectaServidor']     = true;         // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao']          = true;         // Inicia a sessão com um session_start()?
$_SG['caseSensitive']       = false;        // Usar case-sensitive? Onde 'teste' é diferente de 'TESTE'
$_SG['validaSempre']        = true;         // Deseja validar o usuário e a senha a cada carregamento de página?
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.

// Verifica se precisa iniciar a sessão
/*if ($_SG['abreSessao'] == true) {
session_start();
}*/

/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/
function validaUsuario($usuario,$senha) {
global $_SG;
$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

// Usa a função addslashes para escapar as aspas
$nusuario = addslashes($usuario);
$nsenha = addslashes($senha);
$query = new consulta();
    $query->campo       = "id,email,senha,nome,tipo_usuario";
    $query->tabela      = "arpag_pessoa";
    $query->parametro   = $cS." cpf = '".$nusuario."' AND ".$cS." senha = '".$nsenha."'";

    $retorno = select_db($query);
    $resultado =  $retorno->fetch_assoc();

// Verifica se encontrou algum registro
if (empty($resultado)) {
// Nenhum registro foi encontrado => o usuário é inválido
return false;
} else {
// O registro foi encontrado => o usuário é valido

// Definimos dois valores na sessão com os dados do usuário
$_SESSION['usuarioID'] = cript($resultado['id']); // Pega o valor da coluna 'id do registro encontrado no MySQL
$_SESSION['usuarioNome'] = $resultado['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
$_SESSION['tipoUsuario'] = $resultado['tipo_usuario']; // Pega o valor da coluna 'tipousuario' do registro encontrado no MySQL

// Verifica a opção se sempre validar o login
if ($_SG['validaSempre'] == true) {
// Definimos dois valores na sessão com os dados do login
$_SESSION['usuarioLogin'] = $usuario;
$_SESSION['usuarioSenha'] = $senha;
}

return true;
}
}
/**
* Função que protege uma página
*/
function protegePagina($pagina) {
    global $_SG;
    $server = $_SERVER['SERVER_NAME'];
    //if($_SESSION['tipoUsuario'] != $pagina){//expulsaVisitante();}

    if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
        // Não há usuário logado, manda pra página de login
        //expulsaVisitante();
    } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
        // Há usuário logado, verifica se precisa validar o login novamente
        if ($_SG['validaSempre'] == true) {
            // Verifica se os dados salvos na sessão batem com os dados do banco de dados
            if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
                // Os dados não batem, manda pra tela de login
                //expulsaVisitante();
            }
        }
    }
}

//function salva_log(){
 //2014-09-12 09:01:06
//$dathora = date('Ymdhis');
//mysql_query("insert into " . $_SG['banco'] . ".cop_logs (id_usuario, pagina, data_hora) values(".$_SESSION['usuarioID'].", '".$server . $endereco."', ".$dathora.");")or die(expulsaVisitante());
//}

/**
* Função para expulsar um visitante
*/
function expulsaVisitante() {
//global $_SG;

// Remove as variáveis da sessão (caso elas existam)
unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'], $_SESSION['tipoUsuario']);

// Manda pra tela de login
header("Location: index.php");

}

?>
