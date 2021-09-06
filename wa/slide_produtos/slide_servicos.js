function SlideServicos(id) {
    var UrlPainel = $('#SlideServicosWA' + id).attr("data-painel");
    $.ajax({
        type: "GET",
        cache: false,
        url: UrlPainel + 'wa/slide_servicos/slide_servicos.php?id=' + id,
        success: function (data) {
            jQuery('#SlideServicosWA' + id).html(data);
        },
        error: function (data) {
            setTimeout(function () {
                SlideServicos(id);
            }, 5000);
        },
    });
}