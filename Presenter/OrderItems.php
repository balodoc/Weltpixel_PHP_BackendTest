<?php

namespace Services\Presenter;

/**
 * Order items data class.
 */
class OrderItems
{

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
