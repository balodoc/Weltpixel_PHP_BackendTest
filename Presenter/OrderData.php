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
        $funcPrefix = substr($func, 0, 3);
        $attribute = substr($func, 3);

        if ($funcPrefix == 'set' && count($args) > 0) {
            $this->order[$attribute] = $args[0];
        } elseif ($funcPrefix == 'get') {
            return $this->order[$attribute] ?? null;
        } else {
            throw new \RuntimeException('Cannot resolve method: ' . $func);
        }

        return $this;
    }

    /**
     * Push item into objects.
     *
     * @param OrderItems $item Item data instance
     */
    public function addItem(OrderItems $item)
    {
        return $this->items->attach($item);
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * @return \SplObjectStorage
     */
    public function getItems(): \SplObjectStorage
    {
        return $this->items;
    }
}
