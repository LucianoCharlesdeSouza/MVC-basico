<!Doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'Login!'; ?></title>

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

        <?php $this->loadViewInTemplate($viewName, $viewData); ?>

        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>

        <script>
            var BASE = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo back_url("assets/motor_ajax/motor_ajax.js"); ?>"></script>

    </body>
</html>