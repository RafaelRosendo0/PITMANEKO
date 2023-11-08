<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../css/cabecalho2.css">
  <script src="../../js/jquery.min.js"></script>

  <title>EatEasy</title>
</head>

<body>
  <?php require('../../components/header.php') ?>

  <div class="container">
    <button id="cadastrar" class="btn btn-primary mb-4">Cadastrar produto</button>

    <h3>Pedidos:</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Preço</th>
          <th scope="col">Quantidade</th>
          <th scope="col">Código</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function BuscarPedidos() {
      $.ajax({
        url: "../../services/BuscaPedidoLanchoneteController.php",
        type: "GET",
        success: (data) => {
          data = JSON.parse(data)
          let html = "";

          data.data.forEach(element => {
            html += `
          <tr>
            <th scope='row'>${element.id}</th>
            <td>${element.preco}</td>
            <td>${element.quantidade}</td>
            <td>${element.codigo}</td>
            <td class="d-flex align-items-center gap-3">${element.status} ${element.status == "Feito" ? `<span class="badge text-bg-success">Feito</span>
` : `<button id="check" onclick="pedidoFeito(${element.id})" class="btn btn-success d-flex align-items-center justify-content-center  ">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
              </svg></button>`}</td>
          </tr>`
          });

          $("tbody").html(html)
        },
        error: (error) => {
          console.log(error)
        }
      })
    }
    BuscarPedidos()

    function pedidoFeito(id) {
      $.ajax({
        url: "../../services/PedidoFeito.php",
        type: "POST",
        data: {
          id
        },
        success: () => {
          swal.fire({
            title: "Sucesso",
            html: "Pedido alterado com sucesso",
            icon: "success"
          })
          BuscarPedidos()
        }
      })
    }

    $("#cadastrar").click(() => {
      const html = `
          <div class="d-flex align-items-center h-100 px-5 justify-content-center">
            <form class='w-100'>
              <div class='d-flex gap-2 justify-content-between'>
                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="nome">Nome</label>
                  <input type="text" name='nome' id="nome" class="form-control" />
                </div>

                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="cnpj">Preço</label>
                  <input type="number" name='preco' id="preco" class="form-control" />
                </div>
              </div>


                <div class="form-outline mb-4">
                  <label class="form-label" for="categoria">Categoria</label>
                  <select name='categoria' id="categoria" class="form-control">
                    <option value="lanche">Lanche</option>
                    <option value="bebida">Bebida</option>
                    <option value="doce">Doce</option>
                  </select>
                </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-primary w-100 py-2" type="button" id="cadastrar_produto">Cadastrar</button>
              </div>
            </form>
          </div>
      `;

      swal.fire({
        title: "Cadastrar produto",
        html,
        showConfirmButton: false
      })

      $('#cadastrar_produto').click(() => {
        $.ajax({
          url: "../../services/CadastraProdutoController.php",
          type: "POST",
          data: {
            nome: $("#nome").val(),
            preco: $("#preco").val(),
            categoria: $("#categoria").val()
          },
          success: (data) => {
            swal.fire({
              title: "Sucesso",
              html: "Produto cadastrado com sucesso!",
              icon: "success"
            })
          },
          error: (error) => {
            console.log(error)
          }
        })
      })
    })
  </script>
</body>