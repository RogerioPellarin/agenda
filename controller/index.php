<?php

include '_autoload.php';

//login de administrador
$error = 0;
if (isset($_POST['admin_email'])) {
    $settings = new settings();
    if ($settings->validate_email($_POST['admin_email']) && trim($_POST['admin_password']) != "") {
        $admin            = new admin();
        $admin->_email    = $_POST['admin_email'];
        $admin->_password = md5($_POST['admin_password']);
        $admin->login();
        if ($admin->_pk_admin != "") {
            $admin->register_session();
            header("Location: ".$base_url."admin.php");
            die();
        }
        else {
            $error = 1; 
        }
    }
    else {
        $error = 1; 
    }
}

//verifica a criação do contato
$create = 0;
if (isset($_POST['method'])) {
    if ($_POST['method'] == "save") {
        $settings = new settings();
        if ($settings->validate_email($_POST["email"]) && $settings->validate_mobile() && $settings->validate_birthdate() && trim($_POST['name']) != "") {
            $agenda         = new agenda();
            $agenda->_email = mb_strtolower($_POST['email'], "UTF-8");
            if ((int) $agenda->find_by_email() === 0) {
                $agenda->_name      = mb_strtoupper($_POST['name'], "UTF-8");
                $agenda->_mobile    = preg_replace("([^\d]*)", "", $_POST['mobile']);
                $agenda->_birthdate = $settings->human_date_to_date($_POST['birthdate']);
                $agenda->_accept    = preg_replace("([^\d]*)", "", $_POST['accept']);
                $agenda->_status    = 1;
                $create             = $agenda->create();
            }
            else {
                $create = 2;
            }
        }
        else {
            $create = 2;
        }
    }
}


$content = "index";
$js_file = "<script type=\"text/javascript\" src=\"../assets/js/index.js\"></script>";
include ("../view/template/template.php");
