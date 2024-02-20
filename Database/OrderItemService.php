<?php

namespace Services\Database;

class OrderItemService implements OrderItemServiceInterface
{
    /**
     * @var DbHandlerInterface $dbHandler
     */
    protected $dbHandler;

    /**
     * @param DbHandlerInterface $handler
     */
    public function __construct(DbHandlerInterface $handler)
    {
        $this->dbHandler = $handler;
    }

    /**
     * @return array
     */
    public function fetchAll(): array
    {
        return [];
    }

    /**
     * @param int $orderId
     * @param string $status
     *
     * @return mixed|void
     */
    public function setStatusText(int $orderId, string $status)
    {
        // find the order in DB
        // set status to $status
    }

    /**
     * @param int $id
     * @param int $statusId
     *
     * @return mixed|void
     */
    public function setStatusId(int $id, int $statusId)
    {
        // find the order in DB
        // set status to $status
    }
}
