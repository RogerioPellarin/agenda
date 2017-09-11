<?php

include 'conn.php';

class agenda {

    var $_pk_agenda;
    var $_name;
    var $_email;
    var $_mobile;
    var $_birthdate;
    var $_accept;
    var $_status;
    var $_conn;

    function __construct() {
        $this->_conn = conn::mysql();
    }

    public function create() {
        $sql    = "INSERT INTO agenda (
              name,         
              email,  
              mobile,  
              birthdate,
              accept,         
              status
            )
            VALUES (?,?,?,?,?,?)";
        $exe    = $this->_conn->prepare($sql);
        $exe->bind_param("ssisii", $this->_name, $this->_email, $this->_mobile, $this->_birthdate, $this->_accept, $this->_status);
        $return = $exe->execute();
        $conn   = null;
        return $return;
    }

    public function read() {
        $return = array();
        $sql    = "SELECT name, email, mobile, birthdate, accept FROM agenda WHERE status = 1 AND pk_agenda = " . $this->_pk_agenda . " LIMIT 1";
        $result = $this->_conn->query($sql);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function update() {
        $stmt = $this->_conn->prepare("UPDATE agenda SET name=?, email=?, mobile=?, birthdate=?, accept=? WHERE pk_agenda=?");
        $stmt->bind_param('ssisii', $this->_name, $this->_email, $this->_mobile, $this->_birthdate, $this->_accept, $this->_pk_agenda);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    
    public function delete() {
        $stmt = $this->_conn->prepare("UPDATE agenda SET status=0 WHERE pk_agenda=?");
        $stmt->bind_param('i', $this->_pk_agenda);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function find_by_email() {
        $sql    = "SELECT * FROM agenda WHERE email = '" . $this->_email . "' LIMIT 1";
        $result = $this->_conn->query($sql);
        while ($row    = $result->fetch_array()) {
            $this->_pk_agenda = $row["pk_agenda"];
            $this->_name      = $row["name"];
            $this->_emamil    = $row["email"];
            $this->_mobile    = $row["mobile"];
            $this->_birthdate = $row["birthdate"];
            return 1;
        }
        return 0;
    }

    public function fetch_all() {
        $return = array();
        $sql    = "SELECT pk_agenda, name, email, mobile, birthdate, accept FROM agenda WHERE status = 1";
        $result = $this->_conn->query($sql);
        while ($row    = $result->fetch_array(MYSQLI_ASSOC)) {
            $return[] = $row;
        }
        return $return;
    }

    public function get_ages() {
        $return = array();
        $sql    = "SELECT YEAR(CURRENT_TIMESTAMP) - YEAR(birthdate) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(birthdate, 5)) AS age FROM agenda WHERE status = 1;";
        $result = $this->_conn->query($sql);
        while ($row    = $result->fetch_array(MYSQLI_ASSOC)) {
            $return[] = $row["age"];
        }
        return $return;
    }

    public function get_accept() {
        $return = array();
        $sql    = "SELECT COUNT(accept) AS total, accept FROM agenda  WHERE status = 1 GROUP BY accept;";
        $result = $this->_conn->query($sql);
        while ($row    = $result->fetch_array(MYSQLI_ASSOC)) {
            $return[] = $row;
        }
        return $return;
    }

}
