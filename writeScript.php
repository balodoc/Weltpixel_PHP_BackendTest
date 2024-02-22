<?php

use Services\Database\MysqlDbHandler;
use Services\Database\OrderDbService;
use Services\Notifier\EmailNotifier;
use Services\Notifier\OrderEmailFormatter;
use Services\Presenter\OrderData;
use Services\Presenter\OrderDataPresenter;
use Services\Presenter\OrderItems;

require 'vendor/autoload.php';

$orderService = new OrderDbService(new MysqlDbHandler());
$options = [
    'conditions' => [
        'FirstName' => ['operator' => '=', 'value' => 'Weltpixel'],
        'OrderItems_Item_ItemStatus' => ['operator' => '=', 'value' => OrderItems::ITEM_STATUS_SHIPPED]
    ]
];
$shippedOrders = $orderService->fetchAll($options);

$presenter = new OrderDataPresenter();
$shippedOrderObjects = $presenter->format($shippedOrders);

$emailNotifier = new EmailNotifier();
$emailFormatter = new OrderEmailFormatter();

if ($emailNotifier->connect()) {
    foreach ($shippedOrderObjects as $orderObject) {
        $name = $orderObject->getFirstName() . ' ' . $orderObject->getLastName();
        $emailNotifier->setSubject($name . ' Order Status');
        $emailNotifier->addReceiver($orderObject->getOrderEmail(), $name);
        $message = $emailFormatter->format($orderObject);
        if (!$emailNotifier->send($message)) {
            echo $emailNotifier->getError() . PHP_EOL;
        } else {
            echo 'Email sent' . PHP_EOL;
        }
    }
}

$itemIdsToUpdate = [];
/** @var OrderData $orderData */
foreach ($shippedOrderObjects as $orderData) {
    foreach ($orderData->getItems() as $orderItem) {
        /** @noinspection PhpUndefinedMethodInspection */
        $itemIdsToUpdate[] = [
            'order' => $orderData->getOrderID(),
            'item' => $orderItem->getOrderItems_Item_ItemID(),
        ];
    }
}

foreach ($itemIdsToUpdate as $itemIdToUpdate) {
    $orderService->setStatusId(
        $itemIdToUpdate['order'],
        $itemIdToUpdate['item'],
        OrderItems::ITEM_STATUS_ID_10
    );

    $orderService->setStatusText(
        $itemIdToUpdate['order'],
        $itemIdToUpdate['item'],
        OrderItems::ITEM_STATUS_NOTIFICATION_SENT
    );
}