<?php

class settings {

    /**
     * Funcao de debug
     */
    function easyPrint($data, $die = 0) {
        print "<pre>";
        print_r($data);
        print "</pre>";
        $die == 1 ? die : "";
    }

    /**
     * Converte uma data humana: 20/01/1980 em data 1980-01-20.
     * Caso a data nao esteja no formato: dd/mm/YYYY, o sistema retorna a data atual
     * 
     * @param string $date
     * @return date
     */
    function human_date_to_date($date, $null = 0) {
        $pattern = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3}|[0-9]{2})$/';
        if (preg_match($pattern, $date)) {
            $h_date = explode("/", $date);
            $year   = $h_date[2] < 100 ? '20' . $h_date[2] : $h_date[2];
            return $year . "-" . $h_date[1] . "-" . $h_date[0];
        }
        else {
            if ($null == 0) {
                return date("Y-m-d");
            }
            else {
                return false;
            }
        }
    }

    /**
     * Converte uma data de timestamp para dd/mm/YYYY
     * 
     * @param string $date
     * @return string
     */
    function date_to_human_date($date, $current = false) {
        if (trim($date) != "" && preg_match('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/', $date)) {
            return date("d/m/Y", strtotime($date));
        }
        elseif ($current) {
            return date("d/m/Y");
        }
        return "";
    }

    /**
     * Valida o formato de email
     * @param type $email
     * @return type
     */
    function validate_email($email) {
        return !filter_var($email, FILTER_VALIDATE_EMAIL) ? 0 : 1;
    }

    /**
     * Valida ddd e celular
     * @return string
     */
    function validate_mobile() {
        $mobile  = preg_replace("([^\d]*)", "", $_POST["mobile"]);
        $ddd     = substr($mobile, 0, 2);
        $celular = substr($mobile, 2, 9);
        if (strlen($mobile) == 11 && $ddd > 10 && (($ddd % 10) > 0) && $celular > 900000000) {
            return 1;
        }
        return 0;
    }

    /**
     * Valida data de nascimento
     * @return boolean
     */
    function validate_birthdate() {
        $pattern = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3}|[0-9]{2})$/';
        if (preg_match($pattern, $_POST["birthdate"])) {
            return 1;
        }
        return 0;
    }

}

//end class