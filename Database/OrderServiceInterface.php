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

    /**
     * @param int $id
     * @param string $status
     *
     * @return mixed
     */
    public function setStatusText(int $id, string $status);

    /**
     * @param int $id
     * @param int $statusId
     *
     * @return mixed
     */
    public function setStatusId(int $id, int $statusId);
}
