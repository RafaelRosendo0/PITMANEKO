<?php
require('./service.php');

$nome = $_POST["nome"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$service = new Service();

$result = $service->CadastroProduto($nome, $preco, $categoria);

echo json_encode($result);
