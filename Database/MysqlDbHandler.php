<?php

namespace Services\Database;

use PDO;
use PDOException;
use PDOStatement;
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
     * @var PDOStatement $pdoStatement
     */
    protected $pdoStatement;

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
     * @return bool
     *
     * @throws RuntimeException
     */
    public function execute(): bool
    {
        try {
            return $this->pdoStatement->execute();
        } catch (PDOException $e) {
            throw new RuntimeException('Error executing statement');
        }
    }

    /**
     * @param string $pdoStatement
     *
     * @return void
     */
    public function createStatement(string $pdoStatement)
    {
        $this->pdoStatement = $this->connection->prepare($pdoStatement);
    }

    /**
     * @param array $options
     *
     * @return array
     *
     * @throws RuntimeException
     */
    public function select(array $options): array
    {
        if (empty($options)) {
            throw new RuntimeException();
        }

        $tableName = $options['table'];
        $conditions = $options['conditions'];
        $columns = empty($options['columns'])
            ? '*'
            : implode(', ', $options['columns'])
        ;

        $order = $options['order'] ?? null;
        $limit = $options['limit'] ?? null;

        $query = sprintf("SELECT %s FROM %s ", $columns, $tableName);

        if ($conditions) {
            $query .= ' WHERE ';
            foreach ($conditions as $column => $operation) {
                $query .= "{$column} {$operation['operator']} :$column AND ";
            }
            $query = rtrim($query, 'AND ');
        }

        if ($order) {
            if (isset($order['key']) && isset($order['direction'])) {
                $query .= " ORDER BY {$order['key']} {$order['direction']} ";
            }
        }

        if ($limit) {
            $intLimit = intval($limit);
            $query .= " LIMIT {$intLimit} ";
        }

        $this->createStatement($query);

        foreach ($conditions as $column => $operation) {
            $this->pdoStatement->bindParam(":$column", $operation['value']);
        }

        $this->execute();

        return $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}
