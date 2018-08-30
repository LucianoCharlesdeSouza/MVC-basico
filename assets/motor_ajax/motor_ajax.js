$(function() {

    var alerts = ["alert", "alert-info", "alert-success", "alert-danger", "alert-warning"];
    var icones = ["fa fa-ban", "fa fa-info", "fa fa-warning", "fa fa-check"];

    $('.ajaxForm').submit(function() {

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
            beforeSend: function(data) {
                $(".btnAjaxForm").addClass("fa-spinner fa-spin");
                $(".btnAjaxClose").html('');

                $.each(alerts, function(key, value) {
                    $('.alerta').removeClass(value);
                });
                $.each(icones, function(key, value) {
                    $('.icones').removeClass(value);
                });



            },
            success: function(data) {
                $(".btnAjaxForm").removeClass("fa-spinner fa-spin");

                $('.alerta').fadeIn('slow');


                /**
                 * Recupera os dados
                 */
                returnData(data);


                /**
                 * Limpar campos do formulario
                 */
                clearFields(data);

                /**
                 * Redireciona
                 */
                redirect(data);

            }

        });
        return false;
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
            beforeSend: function(data) {
                $(".btnAjaxClose").html('');
            },
            success: function(data) {

                $('.alerta').fadeIn('slow');

                /**
                 * Aplica o efeito na tr da tabela ao excluir
                 */
                deleted(data, tr);

                /**
                 * Recupera os dados
                 */
                returnData(data);

                /**
                 * Redireciona
                 */
                redirect(data);

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

    function returnData(data)
    {
        if (data.return) {
            $(".btnAjaxClose").html('&times;');
            $('.alerta').addClass(data.return[0]);
            $('.icones').addClass(data.return[1]);
            $('.titulo').html(data.return[2]);
            $('.result').html(data.return[3]);

            closeBox();
        }
    }

    function closeBox()
    {
        window.setTimeout(function() {
            $(".alerta").fadeOut('slow');
        }, 4000);

    }

    function clearFields(data)
    {
        if (data.clearFields) {
            form.each(function() {
                this.reset();
            });
        }
    }

    function redirect(data)
    {
        if (data.redirect) {
            window.setTimeout(function() {
                window.location.href = BASE + data.redirect[0];
            }, data.redirect[1]);
        }
    }

    function deleted(data, tr)
    {
        if (data.deleted) {
            tr.fadeOut(400, function() {
                tr.remove();
            });
        }
    }
});
