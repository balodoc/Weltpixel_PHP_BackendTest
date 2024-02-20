<?php
namespace Services\Database;

/**
 * DB handler interface.
 */
interface DbHandlerInterface
{
    /**
     * Execute database insert/update.
     *
     * @throws RuntimeException if the query fails to execute
     */
    public function execute();

    /**
     * Select query.
     *
     * @param array $options Query extra options like MongoDB multi, sort, projection, limit, etc
     *
     * @throws RuntimeException if the query fails to run
     *
     * @return array
     */
    public function select(array $options): array;
}
