<?php

use Services\Database\MysqlDbHandler;
use Services\Database\OrderDbService;
use Services\Notifier\EmailNotifier;
use Services\Presenter\OrderDataPresenter;
use Services\Presenter\OrderItems;

require 'vendor/autoload.php';

/**
 * 1. Get all orders from the database that are from Weltpixel.
 */
$orderService = new OrderDbService(new MysqlDbHandler());
$options = [
    'conditions' => [
        'FirstName' => ['operator' => '=', 'value' => 'Weltpixel'],
        'OrderItems_Item_ItemStatus' => ['operator' => '=', 'value' => 'Item Shipped - Tracking Sent']
    ]
];

$shippedOrders = $orderService->fetchAll($options);

/**
 * 2. Send an email notification to the OrderEmail field for the items with status Item Shipped
 * that includes a total amount and the order details(name, date, item id, item price)
 *
 * A) Make use of Presenter model classes to put the order&item data into objects;
 * B) Write a presenter class(that implements PresenterInterface) to format the order;
 * C) Create an email notifier implementation to use along with "PHPMailer" package;
 */

/**
 * 2. A
 * 2. B
 */
$presenter = new OrderDataPresenter();
$shippedOrderObjects = $presenter->format($shippedOrders);

/**
 * 2. C
 */
$notifier = new EmailNotifier();
$messages = [];

foreach ($shippedOrderObjects as $shippedOrder) {
    $emailDetails = [];
    $fullName = $shippedOrder->getFirstName() . ' ' . $shippedOrder->getLastName();
    $emailDetails['orderId'] = $shippedOrder->getOrderID();
    $emailDetails['email'] = $shippedOrder->getOrderEmail();
    $emailDetails['fullName'] = $fullName;
    $emailDetails['orderDate'] = $shippedOrder->getOrderDate();

    /** @var OrderItems $orderItem */
    foreach ($shippedOrder->getItems() as $orderItem) {
        $orderItemData = $orderItem->getProps();
        $emailDetails['items'][] = $orderItemData;
    }

    $messages[] = $emailDetails;
}

if ($notifier->connect([])) {
    foreach ($messages as $message) {
        var_dump($message);
    }
}

/**
 * 3. Update the order records that you sent notification for and set the item statuses
 * to ItemStatus = 'Notification sent & 'ItemStatusId = 10;
 */

