<?php

/**
 * Esta classe é responsavel para o sistema singleton
 * para chamar a funcao de singleton use: conn::mysql();
 *                                        |___| |______|-> nome da funcao
 *                                          |-> classe
 */
class conn {

    private static $conn = null;
    private $data        = array();

    private function __construct() {
        $this->config = parse_ini_file('../config/config.ini', true);

        $host       = 'production';
        self::$conn = new mysqli($this->config[$host]['host'], $this->config[$host]['user'], $this->config[$host]['pass'], $this->config[$host]['database']);
    }

    public static function mysql() {
        if (!isset(self::$conn))
            new conn();
        return self::$conn;
    }

}

//end class
?>