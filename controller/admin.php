<?php

include '_autoload.php';

//efetua o logout
if (isset($_GET['logout'])) {
    session_destroy();
    $base_url = str_replace("?logout", "", $base_url);
    header("Location: " . $base_url);
}
//caso não exista o login, redireciona para a index
if (!isset($_SESSION['pk_admin'])) {
    header("Location: " . $base_url);
}

if (isset($_GET['list'])) {
    $content  = "admin_list";
    $js_file  = "
            <script type=\"text/javascript\" src=\"https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js\"></script>
            <script type=\"text/javascript\" src=\"https://cdn.datatables.net/rowreorder/1.2.2/js/dataTables.rowReorder.min.js\"></script>
            <script type=\"text/javascript\" src=\"https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js\"></script>         
            <script type=\"text/javascript\" src=\"../assets/js/admin_list.js\"></script>";
    $css_file = "
            <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css\"/>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/rowreorder/1.2.2/css/rowReorder.dataTables.min.css\"/>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css\"/>
    ";
    //pega os dados dos contatos
    $agenda   = new agenda();
    $contacts = $agenda->fetch_all();
    $settings = new settings();
}
elseif (isset($_GET['update'])) {
    if (isset($_POST['method'])) {
        if ($_POST['method'] == "update") {
            $update   = false;
            $settings = new settings();
            if ($settings->validate_email($_POST["email"]) && $settings->validate_mobile() && $settings->validate_birthdate() && trim($_POST['name']) != "") {
                $agenda             = new agenda();
                $agenda->_pk_agenda = $_POST['pk_agenda'];
                $agenda->_email     = mb_strtolower($_POST['email'], "UTF-8");
                $agenda->_name      = mb_strtoupper($_POST['name'], "UTF-8");
                $agenda->_mobile    = preg_replace("([^\d]*)", "", $_POST['mobile']);
                $agenda->_birthdate = $settings->human_date_to_date($_POST['birthdate']);
                $agenda->_accept    = preg_replace("([^\d]*)", "", $_POST['accept']);
                $agenda->_status    = 1;
                $update             = $agenda->update();
            }
        }
    }
    header("Location: " . $base_url . "admin.php?list");
}
elseif (isset($_GET['delete'])) {
    if (isset($_POST['method'])) {
        if ($_POST['method'] == "delete") {
            $agenda             = new agenda();
            $agenda->_pk_agenda = $_POST['pk_agenda_delete'];
            $agenda->delete();
        }
    }
    header("Location: " . $base_url . "admin.php?list");
}
else {
    $content = "admin_dashboard";
    $js_file = "<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
            <script type=\"text/javascript\" src=\"../assets/js/admin_dashboard.js\"></script>";
}


include ("../view/template/template.php");



