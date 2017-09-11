<?php

include '_autoload.php';

if (isset($_POST['method'])) {
    if ($_POST['method'] == "get_ages") {
        print_r(json_encode(process_data_ages()));
    }
    elseif ($_POST['method'] == "get_accept") {
        print_r(json_encode(process_data_accept()));
    }
    elseif ($_POST['method'] == "get_agenda") {
        print_r(json_encode(get_data_agenda()));
    }
}

function process_data_ages() {
    $return['menor_dezoito']           = 0;
    $return['entre_dezoito_cinquenta'] = 0;
    $return['entre_cinquenta_setenta'] = 0;
    $return['acima_setenta']           = 0;
    $agenda                            = new agenda();
    $ages                              = $agenda->get_ages();
    if (!empty($ages)) {
        foreach ($ages as $age) {
            if ($age < 18) {
                $return['menor_dezoito'] ++;
            }
            elseif ($age >= 18 && $age <= 50) {
                $return['entre_dezoito_cinquenta'] ++;
            }
            elseif ($age > 50 && $age <= 70) {
                $return['entre_cinquenta_setenta'] ++;
            }
            else {
                $return['acima_setenta'] ++;
            }
        }
    }
    return process_data_chart_ages($return);
}

function process_data_chart_ages($ages) {
    //colunas
    $col0            = array();
    $col0["id"]      = "";
    $col0["label"]   = "Classificação";
    $col0["pattern"] = "";
    $col0["type"]    = "string";

    $col1            = array();
    $col1["id"]      = "";
    $col1["label"]   = "Total";
    $col1["pattern"] = "";
    $col1["type"]    = "number";

    $cols = array($col0, $col1);

    $rows = array();

    $cel0["v"] = "Menor de 18 anos";
    $cel1["v"] = $ages['menor_dezoito'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $cel0["v"] = "Entre 18 e 50 anos";
    $cel1["v"] = $ages['entre_dezoito_cinquenta'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $cel0["v"] = "Entre 50 e 70 anos";
    $cel1["v"] = $ages['entre_cinquenta_setenta'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $cel0["v"] = "Acima de 70 anos";
    $cel1["v"] = $ages['acima_setenta'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $data = array("cols" => $cols, "rows" => $rows);
    return $data;
}

function process_data_accept() {
    $return['ambos']   = 0;
    $return['email']   = 0;
    $return['celular'] = 0;
    $agenda            = new agenda();
    $accept            = $agenda->get_accept();
    if (!empty($accept)) {
        foreach ($accept as $aceita) {
            if ($aceita['accept'] == 0) {
                $return['ambos'] = $aceita['total'];
            }
            elseif ($aceita['accept'] == 1) {
                $return['email'] = $aceita['total'];
            }
            else {
                $return['celular'] = $aceita['total'];
            }
        }
    }

    return process_data_chart_accept($return);
}

function process_data_chart_accept($accept) {

    //colunas
    $col0            = array();
    $col0["id"]      = "";
    $col0["label"]   = "Aceitação";
    $col0["pattern"] = "";
    $col0["type"]    = "string";

    $col1            = array();
    $col1["id"]      = "";
    $col1["label"]   = "Total";
    $col1["pattern"] = "";
    $col1["type"]    = "number";

    $cols = array($col0, $col1);

    $rows      = array();
    $cel0["v"] = "Email e Celular";
    $cel1["v"] = $accept['ambos'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $cel0["v"] = "Somente Email";
    $cel1["v"] = $accept['email'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $cel0["v"] = "Somente Celular";
    $cel1["v"] = $accept['celular'];
    $row0["c"] = array($cel0, $cel1);
    array_push($rows, $row0);

    $data = array("cols" => $cols, "rows" => $rows);
    return $data;
}

function get_data_agenda() {
    $settings            = new settings();
    $agenda              = new agenda();
    $agenda->_pk_agenda  = $_POST['pk_agenda'];
    $return              = $agenda->read();
    $return['birthdate'] = $settings->date_to_human_date($return['birthdate']);
    return $return;
}
