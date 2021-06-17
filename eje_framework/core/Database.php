<?php
namespace app\core;


class Database{

    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $username = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        echo $dsn;
        echo $username;
        echo $password;

        $this->pdo = new \PDO($dsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(){
        $this->createMigrationsTable();
        $newMigrations = [];
        $appliendMigrations = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliendMigrations);
        
        foreach ($toApplyMigrations as $migrations){
            if ($migrations === '.' || $migrations === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migrations; 
            $className = pathinfo($migrations, PATHINFO_FILENAME);
            $instance = new $className();
            echo "Appliying migration $migrations \n";
            $instance->up();
            echo "Applied migration $migrations \n";

            $newMigrations[] = $migrations;
        }
        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }
        else{
            echo "All migrations has been applied \n";
        }
    
    }

    public function createMigrationsTable(){
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `migrations` ( `id` INT NOT NULL AUTO_INCREMENT , `migration` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; ");
    }

    public function getAppliedMigrations(){
        $sql = "SELECT migration FROM migrations";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $newMigrations){
        
        $values = implode(',', array_map(fn($m)=>"('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $values");
        $statement->execute();
    }
}
