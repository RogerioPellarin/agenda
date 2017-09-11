$(document).ready(function () {
    $('#list').DataTable();
});

//validações no cadastro da agenda
$("#name").blur(function () {
    check_name();
});

$("#email").blur(function () {
    check_email();
});

$("#mobile").blur(function () {
    check_mobile();
});

$("#birthdate").blur(function () {
    check_birthdate();
});

function check_name() {
    var name = $("#name").val();
    var space = $.trim(name).indexOf(" ");

    if ($.trim(name) == "" || space < 0) {
        $("#div_name").removeClass("has-success").addClass("has-error");
        $("#error_name").show();
        return false;
    } else {
        $("#div_name").removeClass("has-error").addClass("has-success");
        $("#error_name").hide();
        return true;
    }
}

function check_email() {
    var email = $("#email").val();

    if ($.trim(email) == "") {
        $("#div_email").removeClass("has-success").addClass("has-error");
        $("#error_email").show();
        return false;
    } else {
        $.ajax({
            method: "POST",
            url: $('#base_url').val() + "api_index.php",
            dataType: "json",
            data: {
                method: 'validate_email',
                email: email
            },
            async: false
        }).done(function (value) {
            if (value == 1) {
                $("#msg_email").html("Você deve informar um email válido!");
                $("#div_email").removeClass("has-success").addClass("has-error");
                $("#error_email").show();
                return false;
            }
            else {
                $("#div_email").removeClass("has-error").addClass("has-success");
                $("#error_email").hide();
                return true;
            }
        });
    }
}

function check_mobile() {
    var mobile = $("#mobile").val();
    if ($.trim(mobile) == "") {
        $("#div_mobile").removeClass("has-success").addClass("has-error");
        $("#error_mobile").show();
        return false;
    } else {
        $.ajax({
            method: "POST",
            url: $('#base_url').val() + "api_index.php",
            dataType: "json",
            data: {
                method: 'validate_mobile',
                mobile: mobile
            },
            async: false
        }).done(function (value) {
            if (value) {
                $("#div_mobile").removeClass("has-error").addClass("has-success");
                $("#error_mobile").hide();
                return true;
            } else {
                $("#div_mobile").removeClass("has-success").addClass("has-error");
                $("#error_mobile").show();
                return false;
            }
        });
    }
}

function check_birthdate() {
    var birthdate = $("#birthdate").val();
    if ($.trim(birthdate) == "") {
        $("#div_birthdate").removeClass("has-success").addClass("has-error");
        $("#error_birthdate").show();
        return false;
    } else {
        $.ajax({
            method: "POST",
            url: $('#base_url').val() + "api_index.php",
            dataType: "json",
            data: {
                method: 'validate_birthdate',
                birthdate: birthdate
            },
            async: false
        }).done(function (value) {
            if (value) {
                $("#div_birthdate").removeClass("has-error").addClass("has-success");
                $("#error_birthdate").hide();
                return true;
            } else {
                $("#div_birthdate").removeClass("has-success").addClass("has-error");
                $("#error_birthdate").show();
                return false;
            }
        });
    }
}

$(".update").click(function () {
    var pk_agenda = $(this).attr("pk_agenda");

    $.ajax({
        method: "POST",
        url: $('#base_url').val() + "api_admin.php",
        dataType: "json",
        data: {
            method: 'get_agenda',
            pk_agenda: pk_agenda
        },
        async: false
    }).done(function (value) {
        if (value) {
            $("#pk_agenda").val(pk_agenda);
            $("#name").val(value.name);
            $("#email").val(value.email);
            $("#mobile").val(value.mobile);
            $("#birthdate").val(value.birthdate);
            $("input[name=accept][value=" + value.accept + "]").prop('checked', true);
        }
    });
});

$(".delete").click(function() {
    var pk_agenda = $(this).attr("pk_agenda");
    $("#pk_agenda_delete").val(pk_agenda);
});