<!Doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'Página não encontrada!'; ?></title>

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
                background-color: #f5f5f5;
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

        <div class="form-signin">

            <img style="width: 100%" class="text-center mb-4" src="<?php echo base_url("/assets/img/bootstrap-solid.svg"); ?>" alt="" width="72" height="72">
            <h3 class="text-center h3 mb-3 font-weight-normal">A url pussui informações não esta autorizada!</h3>

            <p class="text-center mt-5 mb-3 text-muted">&copy; MVC-git / 2017-2018</p>
        </div>
        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>
    </body>
</html>


