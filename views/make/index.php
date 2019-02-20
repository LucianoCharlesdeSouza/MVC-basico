<!Doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'Make Controller'; ?></title>

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

            .form-signin a{
                color: #fff;
            }

            .form-signin .form-control {
                position: relative;
                box-sizing: border-box;
                height: auto;
                padding: 10px;
                font-size: 16px;
            }



        </style>
    </head>

    <body>

        <div class="form-signin">

            <div style="text-align: center;">
                <img class="text-center mb-4" style="text-align: center;" src="<?php echo base_url("/views/make/logo.png"); ?>" alt="">
            </div>
            <h1 class="text-muted text-center h1 mb-3 font-weight-normal">Make</h1>


            <a href="<?php echo base_url("/make/controller"); ?>" class="btn btn-lg btn-primary btn-block">Create Controller/View</a>
            <a href="<?php echo base_url("/make/model"); ?>" class="btn btn-lg btn-primary btn-block">Create Model</a>
            <br/>
            <p style="text-align: center;">
                <a class="text-muted" href="<?php echo base_url(); ?>">Voltar ao projeto</a>
            </p>


            <p class="text-center mt-5 mb-3 text-muted">&copy; My App in MVC 2018-<?php echo date('Y');?></p>
        </div>

    </body>
</html>
