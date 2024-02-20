<?php
namespace Services\Presenter;

/**
 * Order data model class.
 */
class OrderData
{
    /**
     * Order data.
     *
     * @var array
     */
    private $order;

    /**
     * Items instances storage.
     *
     * @var \SplObjectStorage
     */
    private $items;

    /**
     * Order data constructor.
     */
    public function __construct()
    {
        $this->items = new \SplObjectStorage();
    }

    /**
     * Set order properties.
     *
     * @param string $func Called function
     * @param array  $args Input arguments
     */
    public function __call($func, $args)
    {
    }

    /**
     * Push item into objects.
     *
     * @param \Services\Presenter\OrderItems $item Item data instance
     */
    public function addItem(OrderItems $item)
    {
        return $this->items->attach($item);
    }

}
