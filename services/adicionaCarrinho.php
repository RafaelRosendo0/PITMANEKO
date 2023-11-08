<?php
session_start();
require "../db.php";

$id = $_POST["id"];

$sqlCarrinho = "SELECT id, nome, preco FROM produto WHERE id = $id";
$resultCarrinho = $PDO->query($sqlCarrinho);

if ($resultCarrinho->rowCount() > 0) {
  while ($row = $resultCarrinho->fetch()) {

    $permissao = true;

    foreach ($_SESSION["carrinho"] as $item) {
      if ($item["id"] == $row["id"]) {
        $permissao = false;
        break;
      }
    }
    if ($permissao) {

      array_push($_SESSION['carrinho'], ["id" => $row["id"], "preco" => $row["preco"], "nome" => $row["nome"]]);
    }
  }

  echo json_encode($_SESSION["carrinho"]);
} else {
  echo "0 results";
}
