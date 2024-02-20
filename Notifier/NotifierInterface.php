<?php

namespace Services\Notifier;

/**
 * Notifier interface.
 */
interface NotifierInterface
{
    /**
     * Verify connection details of the email connection.
     *
     * @param array $data
     *
     * @return bool
     */
    public function connect(array $data): bool;

    /**
     * Send Notification.
     *
     * @param string $message
     *
     * @return bool
     */
    public function send(string $message): bool;}
