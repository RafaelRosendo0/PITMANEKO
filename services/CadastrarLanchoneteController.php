<?php
require('./service.php');

$nome = $_POST["nome"];
$cnpj = $_POST["cnpj"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];

$service = new Service();

$result = $service->CadastroLanchonete($nome, $cnpj, $titulo, $descricao);

echo json_encode($result);