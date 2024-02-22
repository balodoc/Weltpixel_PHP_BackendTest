<?php

namespace Services\Database;

interface OrderServiceInterface
{
    /**
     * @param array $options
     *
     * @return array
     */
    public function fetchAll(array $options): array;
}
