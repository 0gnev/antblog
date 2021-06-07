<?php

use Core\Application;

class m0006_has_category
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS articles (
                title INT(11) NOT NULL,
                content INT(11) NOT NULL
            )  ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE has_category";

        $db->pdo->exec($SQL);
    }
}