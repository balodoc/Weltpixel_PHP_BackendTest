<?php

namespace Services\Notifier;

use PHPMailer;
use SMTP;

/**
 * Notify via email.
 */
class EmailNotifier implements NotifierInterface
{
    /**
     * @var PHPMailer $mailer
     */
    protected $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->Port = 465;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'doc.balodoc@gmail.com';
        $this->mailer->Password = 'lufzzuqhiffwcusx';
        $this->mailer->setFrom('doc.balodoc@gmail.com', 'First Last');
        $this->mailer->addReplyTo('doc.balodoc@gmail.com', 'First Last');
        // $this->mailer->addAddress('tacadena.roland@gmail.com', 'John Doe');
        $this->mailer->Subject = 'PHPMailer GMail SMTP test';
        $this->mailer->msgHTML(file_get_contents('contents.html'), __DIR__);
        // $this->mailer->AltBody = 'This is a plain-text message body';
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function connect(array $data): bool
    {
        return true;
    }

    /**
     * @param string $message
     *
     * @return bool
     */
    public function send(string $message): bool
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'doc.balodoc@gmail.com';
        $mail->Password = 'lufzzuqhiffwcusx';
        $mail->setFrom('doc.balodoc@gmail.com', 'First Last');
        $mail->addReplyTo('doc.balodoc@gmail.com', 'First Last');
        $mail->addAddress('tacadena.roland@gmail.com', 'John Doe');
        $mail->Subject = 'PHPMailer GMail SMTP test';
        $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->AltBody = 'This is a plain-text message body';

        return true;
    }
}
