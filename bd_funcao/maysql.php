<?php
//ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
function conect(){
$endereco   = strtolower($_SERVER ['REQUEST_URI']);
$categoria  = "adm";

$host = getenv('DB_HOST');
$db = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

if(strpos($endereco,'adm') !== false){
    $_SG['paginaLogin']     = 'index.php'; // P�gina de login
    $_SG['usuario']         = $user??'arpagc45_user1';
    $_SG['tabela']          = 'arpag_pessoa';

}else{
    $_SG['paginaLogin']   = 'index.php'; // P�gina de login
    $_SG['usuario']       = $user??'arpagc45_user1';
    $_SG['tabela']        = 'arpag_pessoa';
}


    $_SG['servidor']      = $host??'localhost';    // Servidor MySQL
    $_SG['senha']         = $pass??'197592';    // Senha MySQL
    $_SG['banco']         = $db??'arpagc45_arpag';      // Banco de dados MySQL
          // Nome da tabela onde os usu�rios s�o salvos
      // ==============================
      // ======================================
      //   ~ N�o edite a partir deste ponto ~
      // ======================================

$mysql = new mysqli($_SG['servidor'], $_SG['usuario'], $_SG['senha'],$_SG['banco']);
    if (mysqli_connect_errno()) {
        die('N�o foi poss�vel conectar-se ao banco de dados: ' . mysqli_connect_error());
    }
    $mysql->set_charset("utf8");
    return $mysql;
}
function insert_bd($query){
    $conect = conect();
    $sql = "INSERT INTO ".$query->tabela." (".$query->campo.") VALUES(".$query->dados.")";
    //echo $sql;
    if($conect->query($sql)or die(erro_bd($conect->errno))){$conect->close();return true;}
    else{$conect->close();return false;}
}
function insert_bd_return_id($query){
    $conect = conect();
    $sql = "INSERT INTO ".$query->tabela."(".$query->campo.") VALUES(".$query->dados.")";
    //echo $sql;
    if($conect->query($sql)or die(erro_bd($conect->errno))){$id = $conect->insert_id; $conect->close();return $id;}
    else{$conect->close();return false;}
}
function insert_bd_verifica($query){
    $conect = conect();
    $sql = "INSERT INTO ".$query->tabela."(".$query->campo.") SELECT ".$query->dados." FROM DUAL   
            WHERE NOT EXISTS (SELECT 1 FROM ".$query->tabela." WHERE ".$query->verifica.")";
    //  echo $sql;
    if($conect->query($sql)or die(erro_bd($conect->errno))){$ret = $conect->affected_rows; $conect->close();return $ret;}
    else{$conect->close();return false;}
}
function update_bd($query){
    $conect = conect();
    $sql = "UPDATE ".$query->tabela." SET ".$query->campo." WHERE ".$query->parametro;
    //echo $sql;
    if ($conect->query($sql)or die(erro_bd($conect->errno))){$conect->close();return true;}
    else{$conect->close();return false;}
}

function select_db($query){
    $conect = conect();
    $sql = "SELECT ".$query->campo." FROM ".$query->tabela." WHERE ".$query->parametro;
    //echo $sql;
    $result = $conect->query($sql) or die(erro_bd($conect->errno));
    $conect->close();
    return $result;
}

function select_db_2($query){
    $conect = conect();
    $sql = "SELECT ".$query->campo." FROM ".$query->tabela." ORDER BY ".$query->parametro;
    //echo $sql;
    $result = $conect->query($sql) or die(erro_bd($conect->errno));
    $conect->close();
    return $result;
}

function delete_db($query){
    $conect = conect();
    $sql = "DELETE  FROM ".$query->tabela." WHERE ".$query->parametro;
    //echo $sql;
    $result = $conect->query($sql) or die(erro_bd($conect->errno));
    $conect->close();
    return $result;
}

function exec_procidure($query){
    $conect = conect();
    $sql = "CALL ".$query->nome;
    //echo $sql;
    if(($conect->query("SET @idpag=''")or die(erro_bd($conect->errno))) && ($conect->query("CALL arpag_p_criapagamento(@idpag)")or die(erro_bd($conect->errno)))){

        $result = $conect->query("SELECT @idpag") or die(erro_bd($conect->errno));
        $conect->close();
        return $result;
    }

    $conect->close();
}

function exec_procidure2($query){
    $conect = conect();
    $sql = "CALL ".$query->nome."(".$query->variavel.")";
    //echo $sql;
    if($conect->query($sql)or die(erro_bd($conect->errno))){$conect->close();return true;}
    else{ $conect->close();return false;}    
}
?>