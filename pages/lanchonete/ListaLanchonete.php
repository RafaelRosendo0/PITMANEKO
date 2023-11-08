<?php
session_start();


if (!isset($_SESSION["usuario"]) && !$_SESSION["usuario"]) {
  header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho de Compras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../css/cabecalho2.css">
  <script src="../../js/jquery.min.js"></script>
</head>

<body>
  <div class="container-fluid px-5 py-5">
    <div class="d-flex w-100 justify-content-between mb-5">
      <p>Olá <span class="fw-bold"><?= $_SESSION["usuario"]["nome"] ?>!</span></p>
      <div class="d-flex align-items-center gap-2">
        <button id="adicionar" class="btn btn-primary py-1">Adicionar</button>
        <button id="desloga" class="btn btn-danger py-2 d-flex align-items-center justify-content-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
          </svg>
        </button>
      </div>
    </div>


    <div class="container d-flex flex-column gap-3">
      <h2>Lanchonetes disponíveis:</h2>

      <div id="cards_container" class="d-flex flex-column gap-3"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <script>
    $('#desloga').click(() => {
      window.location.href = "/PITMANEKO/index.php"
    })


    function listaLanconetetes() {
      $.ajax({
        url: "../../services/ListaLanchoneteController.php",
        type: "GET",
        success: (data) => {
          let html = "";

          try {
            data = JSON.parse(data)

            if (!data.resultado) {
              $("#cards_container").html(data.message)
            } else {
              data.data.forEach(element => {
                let config = false

                if (element.id_usuario == <?= $_SESSION["usuario"]["id"] ?>) {
                  config = true
                }

                html += `
                  <div class="card">
                    <h5 class="card-header d-flex align-items-center gap-2">${element.nome} ${config ? `<span class="badge text-bg-primary">Minha</span>` : ""}</h5>
                    <div class="card-body">
                      <h5 class="card-title">${element.titulo}</h5>
                      <p class="card-text">${element.descricao}</p>
                      <button class="btn btn-primary px-5" onclick='entrar(${JSON.stringify(element)})'>Entrar</button>
                      ${config ? `<a href="./ConfigurarLanchonete.php" class="btn btn-secondary px-5" type="button" id="configurar">Configurar</a>` : ""}
                    </div>
                  </div>
                `;
              });

              $('#cards_container').html(html)
            }
          } catch (e) {
            swal.fire({
              title: "Erro",
              icon: "error",
              html: "Ocorreu um erro, contate o suporte"
            })
          }
        },
        error: (error) => {
          console.log(error)
        }
      })
    }

    function entrar(lanchonete) {

      $.ajax({
        url: "../../services/EntraLanchonete.php",
        type: "POST",
        data: {
          lanchonete
        },
        success: (data) => {
          window.location.href = "/PITMANEKO/home.php"
        },
        error: (error) => {
          console.log(error)
        }
      })
    }

    listaLanconetetes()

    $("#adicionar").click(() => {
      const html = `
      <div class="d-flex align-items-center h-100 px-5 justify-content-center">
            <form class='w-100'>
              <div class='d-flex gap-2 justify-content-between'>
                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="nome">Nome</label>
                  <input type="text" name='nome' id="nome" class="form-control" />
                </div>

                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="cnpj">CNPJ</label>
                  <input type="text" maxlength="18" name='cnpj' id="cnpj" class="form-control" />
                </div>
              </div>


                <div class="form-outline mb-4">
                  <label class="form-label" for="titulo">Título</label>
                  <input type="text" name='titulo' id="titulo" class="form-control" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="descricao">Descrição</label>
                  <textarea name='descricao' id="descricao" class="form-control"></textarea>
                </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-primary w-100 py-2" type="button" id="cadastrar">Cadastrar</button>
              </div>
            </form>
          </div>
      `;

      swal.fire({
        title: "Adicionar lanchonete",
        html,
        showConfirmButton: false
      })

      $("#cadastrar").click(() => {
        $.ajax({
          url: "../../services/CadastrarLanchoneteController.php",
          type: "POST",
          data: {
            nome: $("#nome").val(),
            cnpj: $("#cnpj").val(),
            titulo: $("#titulo").val(),
            descricao: $("#descricao").val(),
          },
          success: (data) => {
            swal.fire({
              title: "Sucesso",
              html: "Lanchonete cadastrada!!",
              icon: "success"
            })
            listaLanconetetes()
          },
          error: (error) => {
            console.log(error)
          }
        })
      })

      $("#cnpj").mask("00.000.000/0000-00");
    })
  </script>

</body>