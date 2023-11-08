<?php
session_start();

if (!isset($_SESSION["usuario"]) && !$_SESSION["usuario"]) {
  header("Location: ../../index.php");
}

if (!isset($_SESSION["lanchonete"]) && !$_SESSION["lanchonete"]) {
  header("Location: pages/lanchonete/ListaLanchonete.php");
}


$_SESSION['carrinho'] = [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="css/cabecalho2.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="./js/jquery.min.js"></script>
  <title>EatEasy</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary w-100">
    <div class="container d-flex align-items-center ">
      <a class="navbar-brand" href="home.php" id="logo">EatEasy</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pages/suporte/suporte.php">Suporte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/pedido/pedido.php">Meus Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/sobrenos/sobrenos.php">Sobre Nós</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pages/lanchonete/ListaLanchonete.php">Lanchonetes</a>
          </li>
          <li class="nav-item">
            <button class="nav-link" id="avaliar">Avaliar</button>
          </li>
        </ul>
      </div>
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
    </div>
  </nav>


  <div id="carouselExample" class="carousel slide mb-5">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img style='height: 350px; object-fit: cover;' src="./img/cachorrao.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img style='height: 350px; object-fit: cover;' src="./img/burgao.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img style='height: 350px; object-fit: cover;' src="./img/bebida.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="px-4" style="
          display: flex;
          justify-content: flex-start;
          align-items: center;
          gap: 20px
        ">

    <div class="card" style="width: 26rem;">
      <img src="img/sanduba.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Lanches</h5>
        <p class="card-text">Todos os lanches vendidos pela nossa lanchonete!</p>
        <a href="./pages/lanches/lanches.php" class="btn btn-primary">Ver produtos</a>
      </div>
    </div>

    <div class="card" style="width: 26rem;">
      <img src="img/bebida.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Bebidas</h5>
        <p class="card-text">Todas as bebidas vendidas pela nossa lanchonete!</p>
        <a href="./pages/bebidas/bebidas.php" class="btn btn-primary">Ver produtos</a>
      </div>
    </div>

    <div class="card" style="width: 26rem;">
      <img src="img/doce.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Doces</h5>
        <p class="card-text">Todos os doces vendidos pela nossa lanchonete!</p>
        <a href="./pages/doces/doces.php" class="btn btn-primary">Ver produtos</a>
      </div>
    </div>

    <!-- <div id="produto">
      <img id="img" src="img/sanduba.jpg" alt="" /><a id="a" href="lanches.php">Lanches</a><img id="seta1" src="img/seta.png" alt="" />
    </div>
    <div id="produto">
      <img id="img" src="img/bebida.jpg" alt="" /><a id="a" href="bebidas.php">Bebidas</a><img id="seta2" src="img/seta.png" alt="" />
    </div>
    <div id="produto">
      <img id="img" src="img/doce.jpg" alt="" /><a id="a" href="doces.php">Doces</a><img id="seta3" src="img/seta.png" alt="" />
    </div> -->
  </div>
  <p id="marca1">EatEasy</p>
  <p id="marca2">Corporation</p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

  <script>
    $('#desloga').click(() => {
      window.location.href = "/PITMANEKO/index.php"
    })
    $("#avaliar").click(() => {
      const html = `<div class="">

<div class="col-md-12">

  <div class="stars">

<form action="">

  <input class="star star-5" id="star-5" type="radio" name="star"/>

  <label class="star star-5" for="star-5"></label>

  <input class="star star-4" id="star-4" type="radio" name="star"/>

  <label class="star star-4" for="star-4"></label>

  <input class="star star-3" id="star-3" type="radio" name="star"/>

  <label class="star star-3" for="star-3"></label>

  <input class="star star-2" id="star-2" type="radio" name="star"/>

  <label class="star star-2" for="star-2"></label>

  <input class="star star-1" id="star-1" type="radio" name="star"/>

  <label class="star star-1" for="star-1"></label>

</form>

</div>


  
</div>


</div>`;

      swal.fire({
        title: "Avaliar",
        html,
        icon: "info"
      }).then((result) => {
        if (result) {
          swal.fire({
            icon: "success",
            html: "Obrigado!"
          })
        }
      })
    })
  </script>

</body>

</html>