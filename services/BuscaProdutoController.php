<?php
require('./service.php');

$categoria = $_POST["categoria"];

$service = new Service();

$result = $service->BuscarProdutos($categoria);

echo json_encode($result);