<?php

use Core\Application;

class m0005_category
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS articles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name TEXT NOT NULL,
                seo_title TEXT NOT NULL
            )  ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE category";

        $db->pdo->exec($SQL);
    }
}