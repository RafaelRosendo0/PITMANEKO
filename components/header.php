<?php
session_start();


if (!isset($_SESSION["usuario"]) && !$_SESSION["usuario"]) {
  header("Location: ../../index.php");
}

if (!isset($_SESSION["lanchonete"]) && !$_SESSION["lanchonete"]) {
  header("Location: ../lanchonete/ListaLanchonete.php");
}

?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg bg-body-tertiary w-100 mb-4">
  <div class="container">
    <a class="navbar-brand" href="../../home.php" id="logo">EatEasy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3 d-flex">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../suporte/suporte.php">Suporte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pedido/pedido.php">Meus Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../sobrenos/sobrenos.php">Sobre Nós</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../lanchonete/ListaLanchonete.php">Lanchonetes</a>
        </li>
        <form class="d-flex" role="search" method="POST">
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" id="search" name="search">
          <input class="btn btn-outline-success" name="formPesquisa" type="submit" value="Pesquisar">
        </form>
      </ul>
      <div class="d-flex gap-2 align-items-center">
        <div class="d-flex flex-column">

          <p class="m-0 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#525252" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg> <span class="fw-bold"><?= $_SESSION["usuario"]["nome"] ?>!</span>
          </p>
          <p style="width: 160px" class="m-0">Lanchonete <span class="fw-bold"><?= $_SESSION["lanchonete"]["nome"] ?>!</span></p>

        </div>
        <button id="desloga" class="btn btn-danger py-2 d-flex align-items-center justify-content-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
          </svg>
        </button>
      </div>
      <a href="../carrinho/carrinho.php">
        <button type="button" class="btn d-flex align-items-center gap-3 btn-outline-primary mx-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
          </svg>
        </button>
      </a>

      <script>
        $('#desloga').click(() => {
          window.location.href = "/PITMANEKO/index.php"
        })
      </script>
    </div>
</nav>