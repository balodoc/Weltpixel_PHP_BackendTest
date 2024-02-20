<?php

namespace Services\Database;

use PDO;
use PDOException;
use RuntimeException;

class MysqlDbHandler implements DbHandlerInterface
{
    /**
     * @var string $host
     */
    protected $host = 'localhost';

    /**
     * @var string $dbName
     */
    protected $dbName = 'weltpixel';

    /**
     * @var string $username
     */
    protected $username = 'root';

    /**
     * @var string $password
     */
    protected $password = 'rtacadena';

    /**
     * @var PDO|null $connection
     */
    protected $connection;

    /**
     * Initialize connection.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Opens PDO connection or die on Exception.
     *
     * @return PDO|void
     */
    public function connect()
    {
        $this->connection = null;

        try {
            $connectionStr = "mysql:host=$this->host;dbname=$this->dbName;charset=UTF8";
            $connectionOptions = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
            $this->connection = new PDO($connectionStr, $this->username, $this->password, $connectionOptions);
        } catch (PDOException $e) {
            echo "Connection error: {$e->getMessage()}\n.";
            die();
        }

        return $this->connection;
    }

    /**
     * Closes PDO connection.
     *
     * @return void
     */
    public function disconnect()
    {
        $this->connection = null;
    }

    /**
     * @return void
     */
    public function execute() {}

    /**
     * @param array $options
     *
     * @return array
     */
    public function select(array $options): array
    {
        if (empty($options)) {
            throw new RuntimeException();
        }

        $tableName = $options['table'];
        $columns = empty($options['columns'])
            ? '*'
            : implode(', ', $options['columns'])
        ;

        $order = $options['order'] ?? null;
        $limit = $options['limit'] ?? null;

        $query = sprintf("SELECT %s FROM %s ", $columns, $tableName);

        if ($order) {
            if (isset($order['key']) && isset($order['direction'])) {
                $query .= "ORDER BY {$order['key']} {$order['direction']} ";
            }
        }

        if ($limit) {
            $intLimit = intval($limit);
            $query .= "LIMIT {$intLimit} ";
        }

        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
