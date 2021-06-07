<?php

use Core\Application;

class m0003_articles
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS articles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title TEXT NOT NULL,
                content TEXT NOT NULL,
                seo_title TEXT NOT NULL,
                descript VARCHAR(255) NOT NULL,
                OwnerID INT NOT NULL,
                image VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE articles";

        $db->pdo->exec($SQL);
    }
}