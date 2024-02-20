<?php

namespace Services\Notifier;

/**
 * Notify via email.
 */
class EmailNotifier implements NotifierInterface
{
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
        return true;
    }
}
