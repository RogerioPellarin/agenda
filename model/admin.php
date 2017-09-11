<?php

include 'conn.php';

class admin {

    var $_pk_admin;
    var $_email;
    var $_password;
    var $_status;

    public function login() {
        $conn = conn::mysql();
        if ($stmt = $conn->prepare("SELECT pk_admin FROM admin WHERE email = ? AND password = ? AND status = 1")) {
            $stmt->bind_param("ss", $this->_email, $this->_password);
            $stmt->execute();
            $stmt->bind_result($pk_admin);
            $stmt->fetch();
            $this->_pk_admin = $pk_admin;
            $stmt->close();
        }
        $conn->close();
    }

    public function register_session() {
        $_SESSION['pk_admin'] = $this->_pk_admin;
        $_SESSION['email']    = $this->_email;
    }
    

}
