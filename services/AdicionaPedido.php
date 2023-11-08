<?php
session_start();
require "../db.php";

$preco = $_POST["preco"];
$quantidade = $_POST["quantidade"];
$tipo = $_POST["tipo"];
$id_usuario = $_SESSION["usuario"]["id"];
$id_lanchonete = $_SESSION["lanchonete"]["id"];
$codigo = $_POST["codigo"];

try {
  $sql = "INSERT INTO pedido (preco, quantidade, tipo_pagamento, id_usuario, id_lanchonete, codigo, status) VALUES ($preco, $quantidade, $tipo, $id_usuario, $id_lanchonete, '$codigo', 'Em andamento')";
  $stmt = $PDO->prepare($sql);

  $stmt->execute();

  echo "Pedido Cadastrado";
} catch (PDOException $e) {
  echo $e->getMessage();
}

  
