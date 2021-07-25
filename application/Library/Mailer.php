<?php

namespace Bullnet\Library;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Bullnet\Core\Logger;

class Mailer 
{


    public static function mail($type, $email, $data = []) 
    {
        try { 
            $mail = new PHPMailer;
            $mail->isMail();
            $mail->SetFrom(EMAIL_FROM, EMAIL_FROM_NAME);
            $mail->AddReplyTo(EMAIL_REPLY_TO);
            $mail->isHTML(true);

            switch($type) {
                case (EMAIL_VERIFICATION):
                    $mail->Body = self::emailVerifyBody($email, $data);
                    $mail->Subject = EMAIL_VERIFICATION_SUBJECT;
                    $mail->AddAddress($email);
                    break;
                case (PASSWORD_RESET):
                    $mail->Body = self::passwordResetBody($email, $data);
                    $mail->Subject = PASSWORD_RESET_SUBJECT;
                    $mail->AddAddress($email);
                    break;
                case (CONTACT_EMAIL_REQUEST):
                    $mail->Body = self::contactEmailBody($email, $data);
                    $mail->Subject = CONTACT_EMAIL_REQUEST_SUBJECT;
                    $mail->AddAddress($email);
                    break;
            }
            $mail->send();
        }catch(Exception $error) {
            Logger::log('SENDING MAIL ERROR', $error->getMessage(), __FILE__, __LINE__);
            return false;
        }
        
    }

    private static function emailVerifyBody($email, $data) 
    {
        $link = urlencode(EMAIL_VERIFICATION_URL . "/" . urlencode($data["token"]));
        $body  = "";
        $body .= "<div>Dear " . $email . ", Please Verify Your Email By Clicking On The Following Link: </div>";
        $body .= "<div>".$link."</div>";
        $body .= ". If you didn't Perform This Action With your email, Please Ignore this Email.";
        $body .= " Regards From DestinySpark";
        return $body;
    }

    private static function passwordResetBody($email, $data) 
    {
        $body  = "";
        $body .= "<div>Dear " . $email . ", Please Use The Following Token To Reset Your Password: </div>";
        $body .= "<h2>".$data['token']."</h2>";
        $body .= " If you didn't Perform This Action With your email, Please ignore this email.";
        return $body;
    }

    public static function contactEmailBody($email, $data) 
    {
        $body  = "";
        $body .= "<h2>".ucwords($data['firstname']." ".$data['lastname'])." Contacted You</h2>";
        $body .= "Email " . $data['email'];
        $body .= ". Phone Number " . $data['phone']; 
        $body .= "<h4>Message Content</h4>";
        $body .= "<em>".$data['message']."</em>";
        return $body;
    }


}