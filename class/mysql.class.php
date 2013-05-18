<?php

class database_mysql {

    var $database = NULL;
    var $sqls = NULL;
    var $host = NULL;
    var $username = NULL;
    var $password = NULL;
    var $databaseName = NULL;
    var $link = NULL;
    var $queries = NULL;
    var $errors = NULL;

    //Crear nueva instancia de una conexion
    function database_mysql($host, $username, $password, $database) {

        $this->host = $host;
        $this->username = sha1($username);
        $this->password = sha1($password);
        $this->database = $database;
        $this->link = "";
        $this->queries = array();
        $this->errors = array();

        $this->sqls = array();

        $this->link = mysql_connect($this->host, $username, $password);
        mysql_select_db($this->database, $this->link);
    }

    //Hacer un query y retornar el resultado a una variable
    function database_query($sql) {
        $this->queries[] = $sql;
        return mysql_query($sql, $this->link);
    }

    function database_scalar($sql) {

        $scalar = "";

        $result = mysql_query($sql, $this->link);

        while ($rowsca = mysql_fetch_array($result)) {
            $scalar = $rowsca[0];
        }

        mysql_free_result($result);

        return $scalar;
    }

    //Cargar resultado 
    function LoadResult($sql) {
        if (!($cur = $this->database_query($sql))) {
            return null;
        }
        $ret = null;
        if ($row = mysql_fetch_row($cur)) {
            $ret = $row[0];
        }
        mysql_free_result($cur);
        return $ret;
    }

    //cargar primera fila
    function LoadFirstRow($sql) {
        if (!($cur = $this->database_query($sql))) {
            return null;
        }
        $ret = null;
        if ($row = mysql_fetch_object($cur)) {
            $ret = $row;
        }
        mysql_free_result($cur);
        return $ret;
    }

    //Retornar el ultimo ID capturado
    function InsertedId($table) {

        $LastID = 0;

        $sqlID = "select IDENT_CURRENT('$table') As NextID ";

        $resultID = mysql_query($sqlID, $this->link);

        while ($rowID = mysql_fetch_array($resultID)) {
            $LastID = $rowID[0];
        }

        mysql_free_result($resultID);

        return $LastID;
    }

    //hacer un query
    function query($sql, $key = "", $returns = true, $batch = false) {
        $sqls = $result = array();

        switch ($batch) {
            default:
            case true:
                foreach ($sql as $index => $query) {
                    $this->queries[] = $query;
                    $answer = mysql_query($query, $this->link);

                    if (!$answer) {
                        $this->errors[] = "n/a"; //odbc_errormsg($this->link);
                    } else {
                        if ($returns != false) {
                            if (mysql_num_rows($answer) > 0) {
                                while ($row = mysql_fetch_object($answer)) {
                                    if ($key != "") {
                                        $result[$index][$row->$key] = $row;
                                    } else {
                                        $result[$index][] = $row;
                                    }
                                }
                            } else {
                                
                            }
                        } else {
                            
                        }
                    }
                }
                break;

            case false:
                $this->queries[] = $sql;
                $answer = mysql_query($sql, $this->link);

                if (!$answer) {
                    $this->errors[] = "n/a"; //odbc_errormsg($this->link);
                    $result = false;
                } else {
                    if ($returns != false) {
                        if (mysql_num_rows($answer) > 0) {
                            while ($row = mysql_fetch_object($answer)) {
                                if ($key != "") {
                                    $result[$row->$key] = $row;
                                } else {
                                    $result[] = $row;
                                }
                            }
                        } else {
                            
                        }
                    } else {
                        $result = true;
                    }
                }
                break;
        }

        return $result;
    }

    function loadObject($sql, &$object) {
        if ($object != null) {
            if (!($cur = $this->database_query($sql))) {
                return false;
            } else {
                
            }
            if ($array = mysql_fetch_array($cur)) {
                mysql_free_result($cur);
                $this->bindArrayToObject($array, $object);
                return true;
            } else {
                return false;
            }
        } else {
            if ($cur = $this->database_query($sql)) {
                if ($object = mysql_fetch_object($cur)) {
                    mysql_free_result($cur);
                    return true;
                } else {
                    $object = null;
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    function bindArrayToObject($array, &$obj) {
        if (!is_array($array) || !is_object($obj)) {
            return (false);
        }

        foreach (get_object_vars($obj) as $k => $v) {
            if (substr($k, 0, 1) != '_') {
                $ak = $k;
                if (isset($array[$ak])) {
                    $obj->$k = $array[$ak];
                }
            }
        }

        return true;
    }

    function formatCSVCell($data) {
        $useQuotes = false;

        $quotable = array(
            "\"" => "\"\"",
            "," => ",",
            "\n" => "\n"
        );

        foreach ($quotable as $char => $repl) {
            if (eregi($char, $data)) {
                $useQuotes = true;
            } else {
                
            }
        }

        if ($useQuotes == true) {
            foreach ($quotable as $char => $repl) {
                $data = str_replace($char, $repl, $data);
            }

            $data = "\"" . $data . "\"";
        } else {
            
        }

        return $data;
    }

    function database_close() {
        //close the connection 
        mysql_close($this->link);
    }

    function database_freemem($recordSet) {
        mysql_free_result($recordSet);
    }

    function database_array($recordSet) {
        return mysql_fetch_array($recordSet);
    }

    function database_sp($storedProcedure) {
        return mysql_init($storedProcedure, $this->link);
    }

    function database_setparams($proc, $paramName, $paramValue, $paramType) {
        return mysql_bind($proc, $paramName, $paramValue, $paramType);
    }

    function database_exec($sp) {
        return mysql_execute($sp);
    }

}

?>