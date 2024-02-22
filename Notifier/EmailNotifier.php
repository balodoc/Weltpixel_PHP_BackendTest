<?php

namespace Services\Notifier;

use Exception;
use PHPMailer;
use phpmailerException;
use SMTP;

/**
 * Notify via email.
 */
class EmailNotifier implements
    NotifierInterface,
    SendableMessageInterface,
    ReplyableMessageInterface
{
    /**
     * @var PHPMailer $mailer
     */
    protected $mailer;

    /**
     * @throws phpmailerException
     */
    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->setDefaults();
    }

    /**
     * @return void
     *
     * @throws phpmailerException
     */
    private function setDefaults()
    {
        $this->mailer->isSMTP();
        $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->Port = 465;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'doc.balodoc@gmail.com';
        $this->mailer->Password = 'lufzzuqhiffwcusx';
        $this->mailer->setFrom('doc.balodoc@gmail.com', 'Roland Tacadena');
        $this->mailer->addReplyTo('doc.balodoc@gmail.com', 'Roland Tacadena');
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function connect(array $data = []): bool
    {
        try {
            $this->mailer->smtpConnect($data);
            $this->mailer->smtpClose();
        } catch (phpmailerException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param string $message
     *
     * @return bool
     */
    public function send(string $message): bool
    {
        $this->mailer->msgHTML($message);

        try {
            if (!$this->mailer->send()) {
                 return false;
            }
        } catch (phpmailerException $e) {
            return false;
        } catch (Exception $e) {
            return false;
        }

        $this->mailer->clearAllRecipients();

        return true;
    }

    /**
     * @param string $to
     * @param string $name
     *
     * @return void
     */
    public function replyTo(string $to, string $name)
    {
        $this->mailer->addReplyTo($to, $name);
    }

    /**
     * @param string $from
     * @param string $name
     *
     * @return void
     *
     * @throws phpmailerException
     */
    public function setFrom(string $from, string $name)
    {
        $this->mailer->setFrom($from, $name);
    }

    /**
     * @param string $to
     * @param string $name
     *
     * @return void
     */
    public function addReceiver(string $to, string $name)
    {
        $this->mailer->addAddress($to, $name);
    }

    /**
     * @param string $subject
     *
     * @return void
     */
    public function setSubject(string $subject)
    {
        $this->mailer->Subject = $subject;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->mailer->ErrorInfo;
    }
}
