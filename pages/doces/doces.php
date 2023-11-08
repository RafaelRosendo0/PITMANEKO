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

    <div class="produtos d-flex flex-wrap gap-4 p-5" id="produtos">
    </div>

    <p id="marca1">EatEasy</p>
    <p id="marca2">Corporation</p>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" data-bs-autohide="false" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header d-flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <strong class="me-auto">Aviso</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Produto adicionado no carrinho!
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let carrinho = [];

        $.ajax({
            url: "../../services/BuscaProdutoController",
            type: "POST",
            data: {
                categoria: "doce"
            },
            success: (data) => {
                data = JSON.parse(data);
                let html = "";

                if (data.data) {
                    if (data.data.length > 0) {
                        data.data.forEach(item => {
                            html += `
                            <div class='card' style='width: 17rem;'>
                            <img src='../../img/cachorrao.jpg' class='card-img-top' alt='...'>
                            <form class='card-body d-flex flex-column align-items-start' method='POST'>
                            <input type='hidden' name='id' value='${item.id}' />
                            <h5 class='card-title'>${item.nome}</h5>
                            <p class='card-text'>R$ ${parseFloat(item.preco).toFixed(2)}</p>
                            <input class='btn btn-primary addbutton' id='liveToastBtn' type='button' value='Adicionar ao carrinho' name='addCarrinho' onclick='add(${item.id})'>
                            </form>
                            </div>
                            `

                            $("#produtos").html(html)
                        })
                    } else {
                        $("#produtos").html("Não possui doces")
                    }
                } else {
                    swal.fire({
                        title: "Erro",
                        icon: "error",
                        html: data.message
                    })
                }
            },
            error: (error) => {
                console.log(error)
            }
        });

        $(".btn-close").click(() => {
            $("#liveToast").removeClass("d-block")
        })

        var add = (id) => {
            $("#liveToast").addClass("d-block")

            $.ajax({
                url: '../../services/adicionaCarrinho.php',
                type: 'POST',
                data: {
                    id,
                    tabela: "doces"
                },
                success: (response) => {
                    carrinho.push(response)
                    let html = "";


                    carrinho.forEach(item => {
                        let obj = JSON.parse(item);

                        html += `<li><a class='dropdown-item' href='#'>${obj.nome}</a></li>`
                    })

                    $("#carrinho").html(html)
                },
                error: (erro) => {
                    console.error(erro)
                }
            })
        }
    </script>
</body>

</html>