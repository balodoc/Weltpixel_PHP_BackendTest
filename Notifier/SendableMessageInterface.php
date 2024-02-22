<?php

namespace Services\Notifier;

interface SendableMessageInterface
{
    /**
     * @param string $from
     * @param string $name
     *
     * @return mixed
     */
    public function setFrom(string $from, string $name);

    /**
     * @param string $to
     * @param string $name
     *
     * @return mixed
     */
    public function addReceiver(string $to, string $name);

    /**
     * @param string $subject
     *
     * @return mixed
     */
    public function setSubject(string $subject);
}
