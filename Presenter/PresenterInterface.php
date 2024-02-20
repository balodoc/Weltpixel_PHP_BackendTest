<?php
namespace Services\Presenter;

/**
 * Presenter interface.
 */
interface PresenterInterface
{
    /**
     * Get the formatted data according to a particular Presenter implementation.
     *
     * @param mixed $data
     *
     * @return array
     */
    public function format($data);
}
