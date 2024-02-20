<?php

namespace Services\Database;

use PDO;
use PDOException;

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
    protected $password = '';

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
        // $stmt = $this->connection->prepare('select * from order_item');
        // $stmt->execute();
        // $x = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // die(var_dump($x));

        return [];
    }
}
