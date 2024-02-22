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
     * @var DbHandlerInterface|MysqlDbHandler $dbHandler
     */
    protected $dbHandler;

    /**
     * @param DbHandlerInterface|MysqlDbHandler $handler
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
            'conditions' => [],
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

        return $this->dbHandler->select(array_merge($defaults, $options));
    }

    /**
     * @param int $orderId
     * @param int $itemId
     * @param string $status
     *
     * @return void
     * @noinspection SqlDialectInspection
     */
    public function setStatusText(int $orderId, int $itemId, string $status)
    {
        $table = self::$table;

        $query = "
            UPDATE `{$table}` 
            SET `OrderItems_Item_ItemStatus` = '$status'
            WHERE `OrderID` = $orderId 
            AND `OrderItems_Item_ItemID` = $itemId
        ";

        $this->dbHandler->createStatement($query);
        $this->dbHandler->execute();
    }

    /**
     * @param int $orderId
     * @param int $itemId
     * @param int $statusId
     *
     * @return void
     */
    public function setStatusId(int $orderId, int $itemId, int $statusId)
    {
        $table = self::$table;

        $query = "
            UPDATE `{$table}` 
            SET `OrderItems_Item_ItemStatusId` = $statusId
            WHERE `OrderID` = $orderId 
            AND `OrderItems_Item_ItemID` = $itemId
        ";

        $this->dbHandler->createStatement($query);
        $this->dbHandler->execute();
    }
}
