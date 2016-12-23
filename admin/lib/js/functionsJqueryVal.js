$(document).ready(function(){

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
            email1: "required",
            email2: {
                equalTo: "#email1"
            },
            telephone: {
                required: true,
                regex:/^(0)[0-9]{1,2}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}$/
            },
            password: "required",
            submitHandler: function(form) {
                form.submit();
            }
        }
    });
    
});
