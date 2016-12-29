$(document).ready(function () {

    $('#submit_pays').remove();
    $('#choix_pays').change(function () {
        var param = $(this).attr('name');
        var val = $(this).val();
        var url = 'index.php?' + param + '=' + val + '&submit_pays=1';
        location.href = url;
    });
    $(".nom_fest").each(function () {
        $(this).parent().find(".detail_fest").hide();
        $(this).click(function () {
            if ($(this).hasClass('txtOrange')) {
                $(this).removeClass('txtOrange');
            } else {
                $(this).addClass('txtOrange');
            }
            $(this).parent().find(".detail_fest").toggle();
        });
    });
    


});


