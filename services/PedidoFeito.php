<?php
require('./service.php');

$id = $_POST["id"];

$service = new Service();

$result = $service->PedidoFeito($id);

echo json_encode($result);