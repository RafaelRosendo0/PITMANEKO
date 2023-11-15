<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cadastro</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

  <section class="vh-100 ">
    <div class="container-fluid h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-sm-6 text-dark d-flex align-items-center justify-content-center ">
          <div class="d-flex align-items-center h-100 px-5 justify-content-center col-12 col-sm-9">
            <form class='w-100'>
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Cadastrar</h3>

              <div class="form-outline mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" name='email' id="email" class="form-control" />
              </div>

              <div class='d-flex gap-2 justify-content-between'>
                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="nome">Nome</label>
                  <input type="text" name='nome' id="nome" class="form-control" />
                </div>

                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="nome">Cpf</label>
                  <input type="text" maxlength="14" name='cpf' id="cpf" class="form-control" />
                </div>
              </div>


              <div class='d-flex gap-2 justify-content-between'>
                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="senha">Senha</label>
                  <input type="password" name='senha' id="senha" class="form-control" />
                </div>

                <div class="form-outline mb-4 w-100">
                  <label class="form-label" for="csenha">Confirmar Senha</label>
                  <input type="password" name='csenha' id="csenha" class="form-control" />
                </div>
              </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-primary w-100 py-2" type="button" id="cadastrar">Cadastrar</button>
              </div>

              <p>Já possui uma conta? <a href="./index.php" class="link-primary">Entre aqui</a></p>

            </form>

          </div>

        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="./img/bg-login.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $('#cpf').mask('000.000.000-00')

    $("#cadastrar").click(() => {
      if ($('#email').val() == "") {
        swal.fire({
          title: "Aviso",
          html: "O email não foi informado!",
          icon: "warning"
        });

        return;
      }

      if ($('#nome').val() == "") {
        swal.fire({
          title: "Aviso",
          html: "O nome não foi informado!",
          icon: "warning"
        });

        return;
      }

      if ($('#cpf').val() == "") {
        swal.fire({
          title: "Aviso",
          html: "O cpf não foi informado!",
          icon: "warning"
        });

        return;
      }

      if ($('#senha').val() == "") {
        swal.fire({
          title: "Aviso",
          html: "A senha não foi informado!",
          icon: "warning"
        });

        return;
      }


      if ($('#senha').val() != $('#csenha').val()) {
        swal.fire({
          title: "Aviso",
          html: "As senhas estão diferentes!",
          icon: "warning"
        });

        return;
      }

      $.ajax({
        url: "./services/auth/CadastroController.php",
        method: "POST",
        data: {
          email: $('#email').val(),
          senha: $('#senha').val(),
          cpf: $('#cpf').val(),
          nome: $('#nome').val(),
        },
        success: (data) => {
          try {
            data = JSON.parse(data);
          } catch (e) {
            swal.fire({
              title: "Erro",
              html: "Ocorreu um erro, contate o suporte",
              icon: "error"
            })

            return;
          }

          if (data.resultado != false) {
            swal.fire({
              title: "Sucesso",
              html: `<p>${data.message}</p><p>Por favor logue!</p>`,
              icon: "success"
            }).then(() => {
              window.location.href = "/PITMANEKO/index.php";
            })
          } else {
            swal.fire({
              title: "Aviso",
              html: data.message,
              icon: "warning"
            })
          }
        },
        error: (error) => {
          swal.fire({
            title: "Erro",
            html: error.message,
            icon: "error"
          })
        }
      });
    })
  </script>
</body>

</html>