<?php

namespace Services\Notifier;

interface EmailFormatterInterface extends FormatterInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function formatMany(array $data): array;
}