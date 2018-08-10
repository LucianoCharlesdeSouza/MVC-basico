<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'MVC-Básico'; ?></title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">MVC-Básico</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <ul class="navbar-nav right">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url("/painel"); ?>">Painel</a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php $this->loadViewInTemplate($viewName, $viewData); ?>

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/popper.min.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>
        <script>
            var BASE = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url("/assets/motor_ajax/motor_ajax.js"); ?>"></script>
    </body>
</html>


