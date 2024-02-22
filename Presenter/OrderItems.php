<?php

namespace Services\Presenter;

/**
 * Order items data class.
 */
class OrderItems
{
    const ITEM_STATUS_SHIPPED = 'Item Shipped - Tracking Sent';
    const ITEM_STATUS_NOTIFICATION_SENT = 'Notification sent';

    const ITEM_STATUS_ID_4 = 4;
    const ITEM_STATUS_ID_29 = 29;
    const ITEM_STATUS_ID_10 = 10;
    const ITEM_STATUS_ID_24 = 24;
    const ITEM_STATUS_ID_17 = 17;

    /**
     * Item data.
     *
     * @var array
     */
    private $item;

    /**
     * Set items properties.
     *
     * @param string $func Called function
     * @param array  $args Input arguments
     */
    public function __call($func, $args)
    {
        $funcPrefix = substr($func, 0, 3);
        $attribute = substr($func, 3);

        if ($funcPrefix == 'set' && count($args) > 0) {
            $this->item[$attribute] = $args[0];
        } elseif ($funcPrefix == 'get') {
            return $this->item[$attribute] ?? null;
        } else {
            throw new \RuntimeException('Cannot resolve method: ' . $func);
        }

        return $this;
    }

    /**
     * Get order item properties.
     *
     * @return array
     */
    public function getProps(): array
    {
        return (array) $this->item;
    }

}
