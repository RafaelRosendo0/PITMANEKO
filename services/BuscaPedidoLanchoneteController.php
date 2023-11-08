<?php
require('./service.php');

$service = new Service();

$pedidos = $service->BuscarPedidosLanchonete();

echo json_encode($pedidos);