<?php

namespace Services\Notifier;

interface FormatterInterface
{
    /**
     * @param $data
     *
     * @return string
     */
    public function format($data): string;
}