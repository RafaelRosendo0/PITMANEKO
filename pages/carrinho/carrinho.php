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
  <?php require('../../components/header.php') ?>

  <section class="container-fluid">
    <div class="container-fluid py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="h5">Produto</th>
                  <th scope="col">Quantidade</th>
                  <th scope="col">Preço</th>
                </tr>
              </thead>
              <tbody>
                <?php

                if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                  foreach ($_SESSION['carrinho'] as $produto) {
                    echo "
                      <tr>
                        <th scope='row'>
                          <div class='d-flex align-items-center'>
                            <img src='../../img/doce.jpg' class='img-fluid rounded-3' style='width: 100px' alt='Book' />
                            <div class='flex-column ms-4'>
                              <p class='mb-2'>" . $produto['nome'] . "</p>
                            </div>
                          </div>
                        </th>
                      <td class='align-middle'>
                        <div class='d-flex flex-row'>
                          <button class='btn btn-link px-2' onclick='this.parentNode.querySelector('input[type=number]').stepDown()'>
                            <i class='fas fa-minus'></i>
                          </button>
                          
                          <input min='0' id='quantidade" . $produto['id'] . "' name='quantidade' value='1' type='number' class='form-control form-control-sm' style='width: 50px' />
                          
                          <button class='btn btn-link px-2' onclick='this.parentNode.querySelector('input[type=number]').stepUp()'>
                            <i class='fas fa-plus'></i>
                          </button>
                        </div>
                      </td>
                      <td class='align-middle'>
                        <p class='price' id='" . $produto['id'] . "' class='mb-0' style='font-weight: 500'>R$" . number_format($produto['preco'], 2, ',', '.') . "</p>
                      </td>
                    </tr>
                    ";
                  }
                } else {
                  echo 'Carrinho Vazio!!';
                }
                ?>
              </tbody>
            </table>
          </div>

          <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px">
            <div class="card-body p-4">
              <div class="row d-flex justify-content-between ">
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                  <form>

                    <div class="d-flex flex-row pb-3">
                      <div class="d-flex align-items-center pe-2">
                        <input class="form-check-input radioPag" type="radio" name="radio" id="radio" value="0" aria-label="..." />
                      </div>
                      <div class="rounded border w-100 p-3">
                        <p class="d-flex align-items-center mb-0">
                          <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Boleto
                        </p>
                      </div>
                    </div>
                    <div class="d-flex flex-row">
                      <div class="d-flex align-items-center pe-2">
                        <input class="form-check-input radioPag" type="radio" name="radio" id="radio" value="1" aria-label="..." />
                      </div>
                      <div class="rounded border w-100 p-3">
                        <p class="d-flex align-items-center mb-0">
                          <i class="fab fa-cc-paypal fa-2x fa-lg text-dark pe-2"></i>Pix
                        </p>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col-lg-4 col-xl-3">
                  <div class="d-flex justify-content-between" style="font-weight: 500">
                    <p class="mb-2">Subtotal</p>
                    <p id="subtotal" class="mb-2"></p>
                  </div>

                  <hr class="my-4" />

                  <div class="d-flex justify-content-between mb-4" style="font-weight: 500">
                    <p class="mb-2">Total</p>
                    <p id="total" class="mb-2"></p>
                  </div>

                  <button id="enviar" type="button" class="btn btn-primary btn-block btn-lg">
                    <div class="d-flex justify-content-between">
                      <span>Comprar</span>
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function calculaTotal() {
      let total = 0;

      $('.price').each((index, item) => {
        total += parseFloat($(item).html().replace('R$', '').replace(',', '.'))
      })

      total = parseFloat(total.toFixed(2))

      $("#subtotal").html('R$' + total.toString().replace('.', ','))


      $("#total").html('R$' + total.toFixed(2).toString().replace('.', ','))
    }

    calculaTotal();


    $('.price').each((index, item) => {
      const preco = $(item).html().replace('R$', '').replace(',', '.')

      $('#quantidade' + $(item).attr('id')).change(() => {
        let precoModificado = parseFloat(preco) * parseFloat($("#quantidade" + $(item).attr('id')).val())

        precoModificado = precoModificado.toFixed(2);

        $(item).html('R$' + precoModificado.toString().replace('.', ','))

        calculaTotal();
      })
    })

    $('.radioPag').each((index, item) => {
      if (!$(item).is(":checked")) {
        $("#enviar").attr('disabled', true)
      } else {
        $("#enviar").attr('disabled', false)
      }

      $(item).change(() => {
        $("#enviar").attr('disabled', false)
      })
    })

    function gerarCaracteresAleatorios(tamanho) {
      const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let resultado = '';
      for (let i = 0; i < tamanho; i++) {
        const indiceAleatorio = Math.floor(Math.random() * caracteres.length);
        resultado += caracteres.charAt(indiceAleatorio);
      }
      return resultado;
    }

    $('#enviar').click(() => {
      const caracteresAleatorios = gerarCaracteresAleatorios(6);

      $.ajax({
        url: "../../services/AdicionaPedido.php",
        method: "POST",
        data: {
          preco: $("#total").html().replace('R$', '').replace(',', '.'),
          quantidade: $("input[name=quantidade]").val(),
          tipo: $("input[name='radio']:checked").val(),
          codigo: "#" + caracteresAleatorios
        },
        success: () => {
          swal.fire({
            title: "Sucesso",
            icon: "success",
            html: "Produto(s) Comprado com sucesso! Código da compra: #" + caracteresAleatorios
          })
        },
        error: (error) => {
          swal.fire({
            title: "Error",
            icon: "error",
            html: "Erro realizar o pedido"
          })
        }
      })
    })
  </script>

  <style>
    @media (min-width: 1025px) {
      .h-custom {
        height: 100vh !important;
      }
    }
  </style>
</body>

</html>