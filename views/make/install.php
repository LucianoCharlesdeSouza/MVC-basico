<!Doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo isset($viewData['title']) ? $viewData['title'] : 'Make Install'; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


        <style>
            html,
            body {
                height: 100%;
            }

            body {
                /*display: -ms-flexbox;*/
                /*display: flex;*/
                /*-ms-flex-align: center;*/
                /*align-items: center;*/
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
            .modalerror{
                position: fixed;
                right: 10px;
                top: 30px;
                width: 360px;
                max-width: 80%;
                padding: 10px 20px 10px 20px;
                cursor: pointer;
                z-index: 9999;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>


        <div class="modalerror alerta ">
            <h4><i class="icon icones "></i><span class="titulo"></span></h4>
            <div class="result"></div>
        </div>

        <div class="col-md-12">
            <div style="text-align: center;">
                <img class="text-center mb-4" style="text-align: center;" src="<?php echo base_url("/views/make/logo.png"); ?>" alt="">
            </div>
            <h3 class="text-center h3 mb-3 font-weight-normal">Settings App</h3>
        </div>
        <div class="row"></div>
        <div class="col-md-8 offset-md-2">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-app-tab" data-toggle="tab" href="#nav-app" role="tab" aria-controls="nav-app" aria-selected="true">App</a>
                    <a class="nav-item nav-link" id="nav-database-tab" data-toggle="tab" href="#nav-database" role="tab" aria-controls="nav-database" aria-selected="false">DataBase</a>
                    <a class="nav-item nav-link" id="nav-mail-tab" data-toggle="tab" href="#nav-mail" role="tab" aria-controls="nav-mail" aria-selected="false">Mail</a>
                </div>
            </nav>

            <?php echo csrf(); ?>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-app" role="tabpanel" aria-labelledby="nav-app-tab">
                    <div class="col-md-12 ">
                        <div class="form-row">
                            <div class="col">
                                <label for="appName">Name</label>
                                <input type="text" class="form-control" id="appName" placeholder="Nome do Projeto">
                            </div>
                            <div class="col">
                                <label for="appKey">Key</label>
                                <input type="text" class="form-control" id="appKey" readonly="" placeholder="Chave única do projeto">
                            </div>
                            <div class="col-md-2">
                                <br/>
                                <button class="btn btn-lg btn-success btn-block create_key"><i class="key "></i> New Key</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="nav-database" role="tabpanel" aria-labelledby="nav-database-tab">
                    <div class="col-md-12 ">
                        <div class="form-row">
                            <div class="col">
                                <label for="databaseHost">Host:</label>
                                <input type="text" class="form-control" id="databaseHost" placeholder="Nome ou IP do Host" value="localhost">
                            </div>
                            <div class="col">
                                <label for="databasePort">Port:</label>
                                <input type="text" class="form-control" id="databasePort" placeholder="Número da Porta" value="3306">
                            </div>
                            <div class="col">
                                <label for="databaseName">DataBase Name:</label>
                                <input type="text" class="form-control" id="databaseName" placeholder="Nome do Banco de Dados">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="databaseUserName">UserName:</label>
                                <input type="text" class="form-control" id="databaseUserName" placeholder="Nome de usuário do banco de dados" value="root">
                            </div>
                            <div class="col">
                                <label for="databaseUserPassword">Password:</label>
                                <input type="password" class="form-control" id="databaseUserPassword" placeholder="Senha de usuário do banco de dados">
                            </div>
                        </div>
                        <br/>

                        <div class="form-row">
                            <div class="col">
                                <label for="databaseUserPassword">Como você gostaria de extrair o dados nas consultas?</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control" id="pdofetchMode">
                                    <option value="PDO::FETCH_OBJ" selected="">Tipo Objeto  Exemplo:  $obj->coluna</option>
                                    <option value="PDO::FETCH_ASSOC">Tipo Array  Exemplo:   $obj['coluna']</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="nav-mail" role="tabpanel" aria-labelledby="nav-mail-tab">
                    <div class="col-md-12 ">
                        <div class="form-row">
                            <div class="col">
                                <label for="mailHost">Host:</label>
                                <input type="text" class="form-control" id="mailHost" placeholder="Nome do Host" value="smtp.gmail.com">
                            </div>
                            <div class="col">
                                <label for="mailPort">Port:</label>
                                <input type="text" class="form-control" id="mailPort" placeholder="Número da Porta" value="587">
                            </div>
                            <div class="col">
                                <label for="mailUserName">User:</label>
                                <input type="email" class="form-control" id="mailUserName" placeholder="E-mail de usuário" value="souzacomprog@gmail.com">
                            </div>
                            <div class="col">
                                <label for="mailUserPassword">Password:</label>
                                <input type="password" class="form-control" id="mailUserPassword" placeholder="Senha de usuário do email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label for="mailsmtpAuth">Autenticação por SMTP?</label>
                                <select class="form-control" id="mailsmtpAuth">
                                    <option value="true" selected="">Sim</option>
                                    <option value="false">Não</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="mailsmtpSecure">Encriptação por?</label>
                                <select class="form-control" id="mailsmtpSecure">
                                    <option value="tls" selected="">TLS</option>
                                    <option value="ssl">SSL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"><br/></div>
                    <div class="col-md-4  offset-md-4">
                        <br/>
                        <button class="btn btn-lg btn-primary btn-block install" type="submit">
                            <i class="setup "></i>
                            Finish settings
                        </button>
                    </div>
                </div>
            </div>


        </div>
        <p class="text-center mt-5 mb-3 text-muted">&copy; My App in MVC 2018-<?php echo date('Y');?></p>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
            var BASE = '<?php echo base_url(); ?>';
        </script>
        <script>

            $(function() {
                $(document).on('click', '.criar_outra', function() {
                    $("#nav-database-tab").click();
                    removeClassAlert();
                });
                $(document).on('click', '.continuar', function() {
                    $.ajax({
                        url: BASE + "/install/continueHome",
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function(data) {
                            removeClassAlert();
                        },
                        success: function(data) {
                            if (data.retorno) {
                                $('.alerta').addClass(data.retorno[0]);
                                $('.icones').addClass(data.retorno[1]);
                                $('.titulo').html(data.retorno[2]);
                                $('.result').html(data.retorno[3]);
                            }

                            if (data.redirect) {
                                window.setTimeout(function() {
                                    window.location.href = BASE + data.redirect[0];
                                }, data.redirect[1]);
                            }
                        }
                    });
                });

                var alerts = ["alert", "alert-info", "alert-success", "alert-danger", "alert-warning"];
                var icones = ["fa fa-ban", "fa fa-info", "fa fa-warning", "fa fa-check"];

                $(".install").click(function() {
                    var appName = $("#appName").val();
                    var appKey = $("#appKey").val();
                    var databaseHost = $("#databaseHost").val();
                    var databasePort = $("#databasePort").val();
                    var databaseName = $("#databaseName").val();
                    var databaseUserName = $("#databaseUserName").val();
                    var databaseUserPassword = $("#databaseUserPassword").val();
                    var pdofetchMode = $("#pdofetchMode").val();
                    var mailHost = $("#mailHost").val();
                    var mailPort = $("#mailPort").val();
                    var mailUserName = $("#mailUserName").val();
                    var mailUserPassword = $("#mailUserPassword").val();
                    var mailsmtpAuth = $("#mailsmtpAuth").val();
                    var mailsmtpSecure = $("#mailsmtpSecure").val();
                    $.ajax({
                        url: BASE + "/install/setup",
                        data: {
                            app_Name: appName,
                            app_Key: appKey,
                            database_Host: databaseHost,
                            database_Port: databasePort,
                            database_Name: databaseName,
                            database_UserName: databaseUserName,
                            database_UserPassword: databaseUserPassword,
                            pdo_fetchMode: pdofetchMode,
                            mail_Host: mailHost,
                            mail_Port: mailPort,
                            mail_UserName: mailUserName,
                            mail_UserPassword: mailUserPassword,
                            mail_smtpAuth: mailsmtpAuth,
                            mail_smtpSecure: mailsmtpSecure
                        },
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function(data) {
                            removeClassAlert();
                            $(".setup").addClass("fa fa-spinner fa-spin");
                        },
                        success: function(data) {
                            $(".setup").removeClass("fa fa-spinner fa-spin");
                            if (data.retorno) {
                                $('.alerta').addClass(data.retorno[0]);
                                $('.icones').addClass(data.retorno[1]);
                                $('.titulo').html(data.retorno[2]);
                                $('.result').html(data.retorno[3]);
                            }

                            if (data.database_empty) {
                                $("#nav-database-tab").click();
                                window.setTimeout(function() {
                                    removeClassAlert();
                                }, 3000);
                            }

                            if (data.redirect) {
                                window.setTimeout(function() {
                                    window.location.href = BASE + data.redirect[0];
                                }, data.redirect[1]);
                            }
                        }
                    });
                });
                $(".create_key").click(function() {

                    $.ajax({
                        url: BASE + "/install/app_Key",
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function(data) {
                            removeClassAlert();
                            $(".key").addClass("fa fa-spinner fa-spin");
                        },
                        success: function(data) {
                            $(".key").removeClass("fa fa-spinner fa-spin");
                            if (data.retorno) {
                                $("#appKey").val(data.retorno);
//                                $('.alerta').addClass(data.retorno[0]);
//                                $('.icones').addClass(data.retorno[1]);
//                                $('.titulo').html(data.retorno[2]);
//                                $('.result').html(data.retorno[3]);
                            }
                            if (data.redirect) {
                                window.setTimeout(function() {
                                    window.location.href = BASE + data.redirect[0];
                                }, data.redirect[1]);
                            }
                        }
                    });
                });
                function removeClassAlert() {
                    $('.titulo').html("");
                    $('.result').html("");
                    $.each(alerts, function(key, value) {
                        $('.alerta').removeClass(value);
                    });
                    $.each(icones, function(key, value) {
                        $('.icones').removeClass(value);
                    });
                }
            });

        </script>
    </body>
</html>
