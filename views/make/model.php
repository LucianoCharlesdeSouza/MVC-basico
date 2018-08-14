<!Doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'Make Model'; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>" rel="stylesheet">


        <style>
            html,
            body {
                height: 100%;
            }

            body {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #fff;
            }

            .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: auto;
            }
            .form-signin .checkbox {
                font-weight: 400;
            }
            .form-signin a{
                color: black;
            }
            .form-signin a:hover{
                color: #0069D9;
            }
            .form-signin .form-control {
                position: relative;
                box-sizing: border-box;
                height: auto;
                padding: 10px;
                font-size: 16px;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>
    </head>

    <body>
        <?php echo boxFlash(); ?>

        <form class="form-signin" method="post" action="<?php echo base_url("/make/createModel"); ?>">

            <div style="text-align: center;">
                <img class="text-center mb-4" style="text-align: center;" src="<?php echo base_url("/views/make/logo.png"); ?>" alt="">
            </div>
            <h3 class="text-muted text-center h3 mb-3 font-weight-normal">Make Model</h3>

            <label for="pathModel" class="sr-only">Name Folder</label>
            <input type="text" name="path_model"  id="pathModel" value="site" class="form-control" placeholder="Nome da Pasta (site ou painel)"  autofocus>

            <label for="nameModel" class="sr-only">Name Model</label>
            <input type="text" name="name_model" id="nameModel" class="form-control" placeholder="Nome do Model" >
            <label for="nameTable" class="sr-only">Name Table</label>
            <input type="text" name="name_table" id="nameTable" class="form-control" placeholder="Nome da Tabela" >

            <button class="btn btn-lg btn-primary btn-block" type="submit">Create Model</button>
            <br/>
            <p>
                <a class="text-muted" style="float:left;" href="<?php echo base_url(); ?>">Voltar ao projeto</a>
                <a class="text-muted" style="float:right;" href="<?php echo base_url("/make"); ?>">Voltar ao make</a>
            </p>
            <p class="text-center mt-5 mb-3 text-muted">&copy; My App in MVC 2017-2018</p>
        </form>
        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>
    </body>
</html>
