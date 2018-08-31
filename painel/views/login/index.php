<!Doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'Login!'; ?></title>

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

        <form class="form-signin" method="POST" action="#">

            <div class="col-md-12 text-center">
                <img class="text-center mb-4" src="<?php echo back_url("/views/make/logo.png"); ?>" alt="" width="72" height="72">
            </div>

            <h3 class="text-center h3 mb-3 font-weight-normal">Insira seus dados para logar</h3>

            <label for="inputEmail" class="sr-only">Email...</label>
            <input type="text" name="user_email" id="inputEmail" class="form-control" placeholder="Email address"  autofocus>

            <label for="inputPassword" class="sr-only">Password...</label>
            <input type="password" name="user_password" id="inputPassword" class="form-control" placeholder="Password" >

            <div class="checkbox mb-3">
                <label style="float: left">
                    <input type="checkbox" name="lembrar" value="remember-me"> Lembrar-me
                </label>

                <label style="float: right;">
                    <a href="#">Cadastrar-me</a>
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>

            <p>
                <a href="#">Recuperar senha</a>
            </p>

            <p class="text-center mt-5 mb-3 text-muted">&copy; MVC-git / 2017-2018</p>

        </form>

        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>

    </body>
</html>