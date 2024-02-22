<?php

namespace Services\Notifier;

interface ReplyableMessageInterface
{
    /**
     * @param string $to
     * @param string $name
     *
     * @return mixed
     */
    public function replyTo(string $to, string $name);
}
