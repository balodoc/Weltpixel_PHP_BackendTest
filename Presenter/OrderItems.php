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
