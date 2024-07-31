<?php

$cont = "cont.txt";


$id = fopen($cont, "r+");
$conteudo = fread($id,filesize($cont));
fclose($id);
clearstatcache();

$conteudo ++;

$id = fopen($cont, "r+");
fwrite($id, $conteudo, strlen($conteudo) + 5);
fclose($id);
clearstatcache();
print ("$conteudo");
?>

