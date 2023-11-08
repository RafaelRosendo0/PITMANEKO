<?php
require('../service.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$service = new Service();

$result = $service->Login($email, $senha);

echo json_encode($result);