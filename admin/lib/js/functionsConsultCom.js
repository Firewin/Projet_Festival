$(document).ready(function () {


    $('#submit_titre').remove();
    $('#choix_titre').change(function () {
        var param = $(this).attr('name');
        var val = $(this).val();
        var url = 'index.php?' + param + '=' + val + '&submit_titre=1';
        location.href = url;
    });
});