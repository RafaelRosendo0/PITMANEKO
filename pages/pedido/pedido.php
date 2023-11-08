<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../css/cabecalho2.css">
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script src="../../js/jquery.min.js"></script>
</head>

<body>
  <?php require('../../components/header.php') ?>

  <div class="w-100 px-5">

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

  <script>
    $.ajax({
      url: "../../services/BuscaPedidoController.php",
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
            <td>${element.status}</td>
          </tr>`
        });

        $("tbody").html(html)
      },
      error: (error) => {
        console.log(error)
      }
    })
  </script>
</body>

</html>