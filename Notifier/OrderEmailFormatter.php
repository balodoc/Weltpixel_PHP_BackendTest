<?php

namespace Services\Notifier;

use Services\Presenter\OrderItems;

class OrderEmailFormatter implements EmailFormatterInterface
{
    /**
     * @param $data
     *
     * @return string
     */
    public function format($data): string
    {
        $fullName = $data->getFirstName() . ' ' . $data->getLastName();
        $message = 'Order Name: ' . $fullName . PHP_EOL;
        $message .= 'Order Date: ' . $data->getOrderDate() . PHP_EOL;

        /** @var OrderItems $item */
        foreach ($data->getItems() as $item) {
            /** @noinspection PhpUndefinedMethodInspection */
            $itemMessage = 'Item Id: ' . $item->getOrderItems_Item_ItemID() . PHP_EOL;
            /** @noinspection PhpUndefinedMethodInspection */
            $itemMessage .= 'Item Price: ' . floatval($item->getOrderItems_Item_ItemPrice()) . PHP_EOL;

            $message .= $itemMessage;
        }

        return $message;
    }

    /**
     * @param array $data
     *
     * @return string[]
     */
    public function formatMany(array $data): array
    {
        $messages = [];

        foreach ($data as $orderObject) {
            $message = $this->format($orderObject);
            $messages[] = $message;
        }

        return $messages;
    }
}