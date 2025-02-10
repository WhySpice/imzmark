<?php
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    private $smtpHost;
    private $smtpPort;
    private $smtpUser;
    private $smtpPass;
    private $senderName;

    public function __construct()
    {
        $this->senderName = SENDER_MAIL;
        $this->smtpHost = SMTP_HOST;
        $this->smtpPort = SMTP_PORT;
        $this->smtpUser = SMTP_USER;
        $this->smtpPass = SMTP_PASS;
    }

    public function send($subject, $header, $message, $recipientEmail)
    {
        require_once __DIR__ . "/../modules/phpMailer/autoload.php";
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $this->smtpHost;
        $mail->Port = $this->smtpPort;
        $mail->SMTPAuth = true;
        $mail->Username = $this->smtpUser;
        $mail->Password = $this->smtpPass;
        $mail->SMTPSecure = 'ssl';

        $mail->setFrom($this->smtpUser, $this->senderName);
        $mail->addAddress($recipientEmail);
        $mail->isHTML(true);

        require_once __DIR__ . "/../modules/phpMailer/template.php";
        $mail->Subject = $subject;
        $mail->Body = $template;

        if ($mail->send()) {
            return true;
        } else {
            return $mail->ErrorInfo;
        }
    }
}