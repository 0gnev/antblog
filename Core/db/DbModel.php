<?php


namespace Core\db;

use Core\Application;
use Core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;
    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
                                    VALUES(".implode(',', $params). ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }
    public function change($id, $attribute, $newmean)
    {
        $tableName = $this->tableName();
        $statement = self::prepare("UPDATE $tableName
        SET $attribute = '$newmean'
        WHERE id = $id;");
        $statement->execute();
        return true;
    }
    
    public function getValueByID($id, $attribute)
    {
        $tableName = $this->tableName();
        $statement = self::prepare("SELECT $attribute from $tableName WHERE id = $id;");
        $statement->execute();
        return true;
    }

    public function findOne($where) // [email => user@example.com, firstname => userName]
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);

    }
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    
}
