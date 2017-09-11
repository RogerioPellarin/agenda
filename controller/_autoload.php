<?php

ini_set("memory_limit", "128M");
date_default_timezone_set('America/Sao_Paulo');

$base_url = base_url();
/**
 * Sistema de autoload, onde para instanciar o objeto é feito por aqui
 *
 * @author Rogerio Barbeiro Morales
 */
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

//// debugagem
//if (@$_GET['error'] == 1) {
//  error_reporting(E_ALL);
//  ini_set("display_errors", 1);
//}else{
//  error_reporting(E_ALL);
//  ini_set("display_errors", 0);
//}
// funcao que carrega as classes automaticamente 
function __autoload($classe) {
    //busca dentro da pasta model a classe necessaria... 
    include_once "../model/{$classe}.php";
}

function base_url() {
    $uri = explode("/", $_SERVER['REQUEST_URI']);
    if (strstr($uri[count($uri)-1], ".php")) {
        array_pop($uri);
        return "http://" . $_SERVER['SERVER_NAME'] . join("/", $uri)."/";
    }
    else {
        return "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
}

?>