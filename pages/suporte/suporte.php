<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../index.css" />
    <link rel="stylesheet" href="../../css/cabecalho2.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="../../js/jquery.min.js"></script>
    <script src="./suporte.js"></script>
    <title>EatEasy</title>
</head>

<body>
<?php require('../../components/header.php') ?>



    <section class="mb-4 d-flex align-items-center justify-content-center flex-column w-full">

        <h2 class="h1-responsive font-weight-bold text-center my-4">Suporte</h2>
        <p class="text-center w-responsive mb-5">Se você tiver dúvidas por favor mande um email, responderemos em até 1 dia útil</p>

        <div class="row d-flex align-items-center justify-content-center">

            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" class="d-flex flex-column gap-4" name="contact-form" action="mail.php" method="POST">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="name" class="">Nome</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="email" class="">Email</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="subject" class="">Assunto</label>
                                <input type="text" id="subject" name="subject" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="md-form">
                                <label for="message">Mensagem</label>
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="text-center text-md-left">
                        <button type='button' class="btn btn-primary" onclick="validaForm()">Enviar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id='toastStatus' class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body" id='status'>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close" id='closeToastStatus'></button>
                </div>
            </div>
        </div>
    </section>
</body>

</html>