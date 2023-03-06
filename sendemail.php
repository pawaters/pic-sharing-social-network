<?php
    require 'vendor/autoload.php';

    use Dotenv\Dotenv;
    use SendGrid\Mail\Mail;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    class SendEmail{

        public static function SendMail($to, $subject, $content){
            $key = getenv('SENDGRID_API_KEY');

            $email = new Mail();
            $email->setFrom("pwaters@student.hive.fi", "Pierre Waters");
            $email->setSubject($subject);
            $email->addTo($to);
            $email->addContent("text/html", $content);

            $sendgrid = new \SendGrid($key);

            try{
                $response = $sendgrid->send($email);
                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
            }catch(Exception $e){
                echo 'Email Exception Caught: ' . $e->getMessage() ."\n";
                return false;
            }
        }
    }
?>