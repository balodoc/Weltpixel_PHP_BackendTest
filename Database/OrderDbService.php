<?php

namespace Services\Database;

use PDO;

class OrderDbService implements OrderServiceInterface
{
    /**
     * @var string
     */
    protected static $table = 'order_item';

    /**
     * @var int|null
     */
    protected static $defaultLimit = null;

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
     * @param array $options
     *
     * @return array
     */
    public function fetchAll(array $options = []): array
    {
        $defaults = [
            'table' => static::$table,
            'columns' => [
                'OrderID',
                'FirstName',
                'LastName',
                'OrderEmail',
                'OrderDate',
                'OrderItems_Item_ItemID',
                'OrderItems_Item_ItemStatus',
                'OrderItems_Item_ItemStatusId',
                'OrderItems_Item_ItemPrice',
            ],
            'order' => [
                'key' => 'OrderID',
                'direction' => 'asc'
            ],
            'limit' => null,
        ];

        return $this->dbHandler->select(
            array_merge($defaults, $options)
        );
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
