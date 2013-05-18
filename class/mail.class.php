<?php

include "../../../components/mail/mail.php";
include "../../../components/mail/mime.php";

class Email_Services {

    function sendNotification($html, $email) {

        $htmlfinal = $html;

        $from = "Planning System <planning.system@hanesbrands.com>";

        $to = $email; //"Arturo Aguirre <arturo.aguirre@hanesbrands.com>";
        $Bcc = "";

        $subject = "Planning System - Password Reset.";

        $host = "10.109.12.89";
        $username = "";
        $password = "";

        $crlf = "\n";

        $hdrs = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'Bcc' => $Bcc);

        $mime = new Mail_Mime($crlf);
        $mime->setHTMLBody($htmlfinal);

        $body = $mime->get();

        $headers = $mime->headers($hdrs);

        $smtp = & Mail::factory('smtp', array('host' => $host, 'auth' => false, 'username' => $username, 'password' => $password));

        $mail = $smtp->send($to, $headers, $body);
    }

    function sendBug($html, $copyDest, $emailDest) {

        $htmlfinal = $html;

        $from = "Planning System <planning.system@hanesbrands.com>";

        $to = "Arturo Aguirre <arturo.aguirre@hanesbrands.com>";
        $Bcc = "";

        $subject = "Planning System - Bug Report.";

        $host = "10.109.12.89";
        $username = "";
        $password = "";

        $crlf = "\n";

        $hdrs = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'Bcc' => $Bcc);

        $mime = new Mail_Mime($crlf);
        $mime->setHTMLBody($htmlfinal);

        $body = $mime->get();

        $headers = $mime->headers($hdrs);

        $smtp = & Mail::factory('smtp', array('host' => $host, 'auth' => false, 'username' => $username, 'password' => $password));

        $mail = $smtp->send($to, $headers, $body);

        //enviar una copia al usuario
        if ($copyDest == '1' && $emailDest != '') {
            try {
                $to = $emailDest;

                $hdrs = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'Bcc' => $Bcc);

                $mime = new Mail_Mime($crlf);
                $mime->setHTMLBody($htmlfinal);

                $body = $mime->get();

                $headers = $mime->headers($hdrs);

                $smtp = & Mail::factory('smtp', array('host' => $host, 'auth' => false, 'username' => $username, 'password' => $password));

                $mail = $smtp->send($to, $headers, $body);
            } catch (Exception $e) {
                
            }
        }
    }

}

?>