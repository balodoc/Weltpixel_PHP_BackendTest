<?php

namespace Services\Presenter;

class OrderDataPresenter implements PresenterInterface
{
    /**
     * @param $data
     *
     * @return array
     */
    public function format($data): array
    {
        return array_map(function (array $order) {
            /** @noinspection PhpUndefinedMethodInspection */
            $orderData = (new OrderData())
                ->setOrderID(
                    $order['OrderID'] ?? null
                )
                ->setFirstName(
                    $order['FirstName'] ?? null
                )
                ->setLastName(
                    $order['LastName'] ?? null
                )
                ->setOrderEmail(
                    $order['OrderEmail'] ?? null
                )
                ->setOrderDate(
                    $order['OrderDate'] ?? null
                );

            /** @noinspection PhpUndefinedMethodInspection */
            $item = (new OrderItems())
                ->setOrderItems_Item_ItemID(
                    $order['OrderItems_Item_ItemID'] ?? null
                )
                ->setOrderItems_Item_ItemStatus(
                    $order['OrderItems_Item_ItemStatus'] ?? null
                )
                ->setOrderItems_Item_ItemStatusId(
                    $order['OrderItems_Item_ItemStatusId'] ?? null
                )
                ->setOrderItems_Item_ItemPrice(
                    $order['OrderItems_Item_ItemPrice'] ?? null
                );

            $orderData->addItem($item);
            return $orderData;

        }, $data);
    }
}
