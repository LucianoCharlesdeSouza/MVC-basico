$(function() {

    var alerts = ["alert", "alert-info", "alert-success", "alert-danger", "alert-warning"];
    var icones = ["fa fa-ban", "fa fa-info", "fa fa-warning", "fa fa-check"];

    $('.ajaxForm').submit(function(event) {

        event.preventDefault();

        var form = $(this);
        var controller = form.attr('data-controller');
        var dados = new FormData($(this)[0]);

        $.ajax({
            url: BASE + controller,
            data: dados,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(response) {
                $(".btnAjaxForm").addClass("fa-spinner fa-spin");
                $(".btnAjaxClose").html('');

                $.each(alerts, function(key, value) {
                    $('.alerta').removeClass(value);
                });
                $.each(icones, function(key, value) {
                    $('.icones').removeClass(value);
                });



            },
            success: function(response) {
                $(".btnAjaxForm").removeClass("fa-spinner fa-spin");

                $('.alerta').fadeIn('slow');


                /**
                 * Recupera os dados
                 */
                returnData(response);


                /**
                 * Limpar campos do formulario
                 */
                clearFields(response);

                /**
                 * Redireciona
                 */
                redirect(response);

            }

        });

    });

    $(document).on("click", ".ajaxDeleteConfirmed", function() {

        var deletar_id = $(this).attr('id');
        var controller = $(this).attr('data-controller');
        var tr = $(this).closest('tr');

        $.ajax({
            url: BASE + controller,
            data: {del_id: deletar_id},
            type: 'POST',
            dataType: 'json',
            beforeSend: function(response) {
                $(".btnAjaxClose").html('');
            },
            success: function(response) {

                $('.alerta').fadeIn('slow');

                /**
                 * Aplica o efeito na tr da tabela ao excluir
                 */
                deleted(response, tr);

                /**
                 * Recupera os dados
                 */
                returnData(response);

                /**
                 * Redireciona
                 */
                redirect(response);

            }

        });



    });
// FIM DO AjaxDELETECONFIRMED

    $(document).on("click", ".btnAjaxClose", function() {
        $('.alerta').fadeOut('slow');
    });

    $(document).on("click", ".ajaxDelete", function() {

        $(this).removeClass('btn-warning');
        $(this).addClass('btn-danger ajaxDeleteConfirmed');

    });
// FIM DO AjaxDELETE

    function returnData(response)
    {
        if (response.return) {
            $(".btnAjaxClose").html('&times;');
            $('.alerta').addClass(response.return[0]);
            $('.icones').addClass(response.return[1]);
            $('.titulo').html(response.return[2]);
            $('.result').html(response.return[3]);

            closeBox();
        }
    }

    function closeBox()
    {
        window.setTimeout(function() {
            $(".alerta").fadeOut('slow');
        }, 4000);

    }

    function clearFields(response)
    {
        if (response.clearFields) {
            form.each(function() {
                this.reset();
            });
        }
    }

    function redirect(response)
    {
        if (response.redirect) {
            window.setTimeout(function() {
                window.location.href = BASE + response.redirect[0];
            }, response.redirect[1]);
        }
    }

    function deleted(response, tr)
    {
        if (response.deleted) {
            tr.fadeOut(400, function() {
                tr.remove();
            });
        }
    }
});
