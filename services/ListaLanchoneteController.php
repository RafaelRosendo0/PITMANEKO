<?php
require('./service.php');

$service = new Service();

$result = $service->ListaLanchonetes();

echo json_encode($result);