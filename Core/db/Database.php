<?php


namespace Core\db;

use Core\Application;

class Database
{
    public \PDO $pdo;
    public function __construct($dbConfig = [])
    {
        $dbDsn = $dbConfig['dsn'] ?? '';
        $username = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';

        $this->pdo = new \PDO($dbDsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigration();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }
    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }
    public function getAppliedMigration()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str
            ");
        $statement->execute();
    }
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}
