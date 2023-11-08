<?php
require('../service.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

$service = new Service();

$result = $service->Cadastro($email, $nome, $cpf, $senha);

echo json_encode($result);