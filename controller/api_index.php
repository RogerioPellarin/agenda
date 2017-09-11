<?php

include '_autoload.php';

if (isset($_POST['method'])) {
    $settings = new settings();

    //métodos de validações para cadastro de contato
    if ($_POST['method'] == "validate_email") {
        if ($settings->validate_email($_POST['email'])) {
            $agenda         = new agenda();
            $agenda->_email = mb_strtolower($_POST['email'], "UTF-8");
            if ($agenda->find_by_email()) {
                print 2;
            }
            else {
                print 0;
            }
        }
        else {
            print 1;
        }
    }
    if ($_POST['method'] == "validate_mobile") {
        print $settings->validate_mobile();
    }
    if ($_POST['method'] == "validate_birthdate") {
        print $settings->validate_birthdate();
    }

    //valida o admin
    if ($_POST['method'] == "validate_admin_email") {
        if ($settings->validate_email($_POST['admin_email'])) {
            print 0;
        }
        else {
            print 1;
        }
    }
}

