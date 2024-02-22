<?php

use Services\Database\MysqlDbHandler;
use Services\Database\OrderDbService;
use Services\Notifier\EmailNotifier;
use Services\Notifier\OrderEmailFormatter;
use Services\Presenter\OrderData;
use Services\Presenter\OrderDataPresenter;
use Services\Presenter\OrderItems;

require 'vendor/autoload.php';

/**
 * 1. Get all orders from the database that are from Weltpixel
 * Hint: Utilize the Database implementation to connect and retrieve data;
 */
$orderService = new OrderDbService(new MysqlDbHandler());
$options = [
    'conditions' => [
        'FirstName' => ['operator' => '=', 'value' => 'Weltpixel'],
        'OrderItems_Item_ItemStatus' => ['operator' => '=', 'value' => OrderItems::ITEM_STATUS_SHIPPED]
    ]
];

$shippedOrders = $orderService->fetchAll($options);

/**
 * 2. Send an email notification to the OrderEmail field for the items with status Item Shipped
 * that includes a total amount and the order details(name, date, item id, item price)
 * Hints:
 *      A) Make use of Presenter model classes to put the order&item data into objects;
 *      B) Write a presenter class(that implements PresenterInterface) to format the order;
 *      C) Create a email notifier implementation to use along with PHPmailer package;
 */

/**
 * 2. A)
 * 2. B)
 */
$presenter = new OrderDataPresenter();
$shippedOrderObjects = $presenter->format($shippedOrders);

$emailNotifier = new EmailNotifier();
$emailFormatter = new OrderEmailFormatter();

/**
 * 2. C)
 */
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

/**
 * 3. Update the order records that you sent notification for and set the item
 * statuses to ItemStatus = 'Notification sent' & ItemStatusId = 10;
 */
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