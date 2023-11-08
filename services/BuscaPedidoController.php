<?php
require('./service.php');

$service = new Service();

$pedidos = $service->BuscarPedidos();

echo json_encode($pedidos);