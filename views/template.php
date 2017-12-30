<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
        <title>MVC FRONT</title>
        <link href="<?= BASE; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= BASE; ?>assets/css/font-awesome.css" rel="stylesheet">

        <script src="<?= BASE; ?>assets/js/jquery.js"></script>
        <script src="<?= BASE; ?>assets/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            var BASE = '<?php echo BASE; ?>';
        </script>
    </head>
    <body>


        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= BASE; ?>">Luciano Charles</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 sidebar">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" <span class="caret">Clientes</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= BASE; ?>clients">Listar</a></li>
                                <li><a href="<?= BASE; ?>clients/add">Adicionar</a></li>
                                <!-- <li role="separator" class="divider"></li> -->
                            </ul>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo BASEADMIN; ?>">Painel</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->


            </div><!-- /.container-fluid -->

        </nav>

        <?php $this->loadViewInTemplate($viewName, $viewData); ?>

        <div class="clearfix"></div>
        <div class="footer">
            <h1>Rodapé do meu site</h1>
        </div>

    </body>
</html>