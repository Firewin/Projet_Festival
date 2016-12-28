$(document).ready(function () {

    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");


    $("#form_inscription").validate({
        rules: {
            nom: "required",
            prenom: "required",
            pays: "required",
            adresse: "required",
            email1: {
                required: true,
                email: true
            },
            email2: {
                equalTo: "#email1",
                email: true
            },
            telephone: {
                required: true,
                regex: /^(0)[0-9]{1,2}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}$/
            },
            password: "required",
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

    $("#form_commande").validate({
        rules: {
            email1_com: {
                required: true,
                email: true
            },
            email2_com: {
                equalTo: "#email1_com",
                email: true
            },
            nom_com: "required",
            prenom_com: "required",
            pays_com: "required",
            adresse_com: "required",
            telephone_com: {
                required: true,
                regex: /^(0)[0-9]{1,2}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}$/
            },
            password_com: "required",
            password_com2: "required",
            submitHandler: function (form) {
                form.submit();
            }
        }
    });

});
