<?php
class database
{
    private $servername = '127.0.0.1';
    private $port = '3306';
    private $username = 'root';
    private $password = '';
    private $databasename = 'myweb';
    protected $conn = null;

    public function connection_database(): PDO
    {
        if ($this->conn === null) {
            $dsn = "mysql:host={$this->servername};port={$this->port};dbname={$this->databasename};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
        return $this->conn;
    }
}
