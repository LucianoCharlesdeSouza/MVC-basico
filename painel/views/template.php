<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>">

        <title>MVC-Básico</title>
        <style>
            .navbar-expand-md .navbar-nav .dropdown-menu {
                position: absolute !important;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="<?php echo back_url(); ?>">Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Usuários</a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Listagem
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Usuários</a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </li>

                </ul>
                <ul class="navbar-nav right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-3 mr-lg-0" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><span class="caret" style="cursor:pointer;">
                                <?php
                                echo sessionHas('login_email') ? getSession('login_email') : 'Usuário';
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="">Meus Dados</a>
                            <a class="dropdown-item" href="#">Sair</a>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
        <?php echo box_flash(); ?>

        <?php $this->loadViewInTemplate($viewName, $viewData); ?>

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/popper.min.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>
        <script>
            var BASE = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo back_url("assets/motor_ajax/motor_ajax.js"); ?>"></script>
    </body>
</html>


