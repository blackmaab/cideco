
<?php

class Error {

    public $page = '';
    public $msj = '';

    public function GuardarError($page, $msj) {
        try {

            $fp = fopen("error_log.txt", "a");
            fwrite($fp, date("d-m-Y H:i:s") . " - $page - " . $msj . PHP_EOL);
            fclose($fp);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
?>



