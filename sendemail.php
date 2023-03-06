<?php
    require 'vendor/autoload.php';
    require __DIR__ . '/vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    class SendEmail{

        public static function SendMail($to, $subject, $content){
            $key = getenv('SENDGRID_API_KEY');

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