<?php
require_once 'vendor/autoload.php';

// endereço do site
const URL = "http://localhost/ProjetoTurmaB-Consessionaria";
$roteador = new CoffeeCode\Router\Router(URL);
$roteador->namespace("Concessionaria\Projetob\Controller");

// rota principal
$roteador->group(null);
$roteador->get("/", "Principal:inicio");

// rota para detalhes do veículo
$roteador->get("/veiculos/{id}", "VeiculosController:detalhes");

$roteador->dispatch();