<?php
    require 'vendor/autoload.php';

    class SendEmail{

        public static function SendMail($to, $subject, $content){
            $key = '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';

            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("pwaters@student.hive.fi", "Pierre Waters");
            $email->setSubject($subject);
            $email->addTo($to);
            $email->addContent("text/html", $content);

            $sendgrid = new \SendGrid($key);

            try{
                $response = $sendgrid->send($email);

            }catch(Exception $e){
                echo 'Email Exception Caught: ' . $e->getMessage() ."\n";
                return false;

            }
        }
    }
?>