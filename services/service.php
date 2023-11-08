<?php
session_start();

class Service
{
  private $PDO;

  public function __construct()
  {
    $this->PDO = new PDO('mysql:host=localhost;dbname=PIT;', 'root', '');
  }


  public function Cadastro($email, $nome, $cpf, $senha): array
  {
    $retorno = [];

    $query = "INSERT INTO usuario (email, senha, nome, cpf) VALUES ('$email', '$senha','$nome','$cpf')";

    $stmt = $this->PDO->prepare($query);

    $result = $stmt->execute();

    if ($result) {
      $retorno["message"] = "Usuário Cadastrado!";
      $retorno["resultado"] = true;
    } else {
      $retorno["message"] = "Ocorreu um erro ao cadastrar o usuário";
      $retorno["resultado"] = false;
    }

    return $retorno;
  }

  public function CadastroProduto($nome, $preco, $categoria)
  {
    $retorno = [];

    $id_lanchonete = $_SESSION["lanchonete"]["id"];

    $query = "INSERT INTO produto (nome, preco, categoria, id_lanchonete) VALUES ('$nome', $preco,'$categoria', $id_lanchonete)";

    $stmt = $this->PDO->prepare($query);

    $result = $stmt->execute();

    if ($result) {
      $retorno["message"] = "Produto Cadastrado!";
      $retorno["resultado"] = true;
    } else {
      $retorno["message"] = "Ocorreu um erro ao cadastrar o produto";
      $retorno["resultado"] = false;
    }

    return $retorno;
  }

  public function CadastroLanchonete($nome, $cnpj, $titulo, $descricao): array
  {
    $retorno = [];

    $id_usuario = $_SESSION["usuario"]["id"];

    $query = "INSERT INTO lanchonete (nome, cnpj, titulo, descricao, id_usuario) VALUES ('$nome', '$cnpj','$titulo','$descricao', $id_usuario)";

    $stmt = $this->PDO->prepare($query);

    $result = $stmt->execute();

    if ($result) {
      $retorno["message"] = "Lanchonete Cadastrada!";
      $retorno["resultado"] = true;
    } else {
      $retorno["message"] = "Ocorreu um erro ao cadastrar a lanchonete";
      $retorno["resultado"] = false;
    }

    return $retorno;
  }

  public function Login($email, $senha)
  {
    $retorno = [];

    $queryUsuario = "SELECT id, email, nome FROM usuario where email = '$email'";

    $result = $this->PDO->query($queryUsuario);


    if (!$result) {
      $retorno["message"] = "Ocorreu um erro ao buscar os dados";
      $retorno["resultado"] = false;

      return $retorno;
    }

    $rowUsuario = $result->fetch(PDO::FETCH_ASSOC);

    if ($rowUsuario) {
      $querySenha = "SELECT senha FROM usuario where email = '$email'";

      $resultSenha = $this->PDO->query($querySenha);

      $rowSenha = $resultSenha->fetch(PDO::FETCH_ASSOC);

      if (!$rowSenha) {
        $retorno["message"] = "Ocorreu um erro ao buscar os dados";
        $retorno["resultado"] = false;

        return $retorno;
      }

      if ($senha == $rowSenha['senha']) {
        $retorno["message"] = "Usuário logado com sucesso!";
        $retorno["resultado"] = true;

        $_SESSION["usuario"] = [
          "id" => $rowUsuario["id"],
          "email" => $rowUsuario["email"],
          "nome" => $rowUsuario["nome"]
        ];
      } else {
        $retorno["message"] = "A senha está errada!";
        $retorno["resultado"] = false;
      }
    } else {
      $retorno["message"] = "Este email não está cadastrado!";
      $retorno["resultado"] = false;
    }

    return $retorno;
  }

  public function ListaLanchonetes()
  {
    $retorno = [];

    $sql = "SELECT * FROM lanchonete";

    $result = $this->PDO->query($sql);


    if (!$result) {
      $retorno["message"] = "Ocorreu um erro ao buscar as lanchonetes";
      $retorno["resultado"] = false;

      return $retorno;
    }

    $lanchonetes = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($lanchonetes) {
      $retorno["data"] = $lanchonetes;
      $retorno["resultado"] = true;
    } else {
      $retorno["message"] = "Não possui lanchonetes cadastradas no sistema";
      $retorno["resultado"] = false;
    }

    return $retorno;
  }

  public function BuscarProdutos($categoria)
  {
    $retorno = [];


    $id_lanchonete = $_SESSION["lanchonete"]["id"];

    $sql = "SELECT id, nome, preco FROM produto where id_lanchonete = $id_lanchonete and categoria = '$categoria'";
    $result = $this->PDO->query($sql)->fetchAll();


    $retorno["data"] = $result;
    $retorno["resultado"] = true;

    return $retorno;
  }

  public function BuscarPedidos()
  {
    $retorno = [];

    $id_usuario = $_SESSION["usuario"]["id"];

    $sql = "SELECT * FROM pedido where id_usuario = $id_usuario";
    $result = $this->PDO->query($sql)->fetchAll();


    $retorno["data"] = $result;
    $retorno["resultado"] = true;

    return $retorno;
  }

  public function BuscarPedidosLanchonete()
  {
    $retorno = [];

    $id_lanchonete = $_SESSION["lanchonete"]["id"];

    $sql = "SELECT * FROM pedido where id_lanchonete = $id_lanchonete";
    $result = $this->PDO->query($sql)->fetchAll();


    $retorno["data"] = $result;
    $retorno["resultado"] = true;

    return $retorno;
  }

  public function PedidoFeito($id)
  {
    $retorno = [];

    $query = "UPDATE pedido set status = 'Feito' where id = $id";

    $stmt = $this->PDO->prepare($query);

    $result = $stmt->execute();

    if ($result) {
      $retorno["message"] = "Pedido Alterado!";
      $retorno["resultado"] = true;
    } else {
      $retorno["message"] = "Ocorreu um erro ao alterar o pedido";
      $retorno["resultado"] = false;
    }

    return $retorno;
  }

  function Pesquisar($pesquisa, $categoria)
  {
    $sql = "SELECT id, nome, preco FROM produto where categoria = '$categoria' and nome like '$pesquisa%'";

    $array_retorno = [];

    $result = $this->PDO->query($sql);

    if ($result->rowCount() > 0) {
      while ($row = $result->fetch()) {
        array_push($array_retorno, [$row["preco"], $row["nome"], $row["id"]]);
      }
    }

    return $array_retorno;
  }
}
