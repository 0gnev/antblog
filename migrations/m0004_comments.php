<?php

use Core\Application;

class m0004_comments
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                comment TEXT NOT NULL,
                CommenterID INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE comments";

        $db->pdo->exec($SQL);
    }
}