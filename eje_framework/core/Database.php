<?php
namespace app\core;


class Database{

    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dns'] ?? '';
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public fucntion applyMigrations(){
        echo "Running applyMigrations ";
    }
}