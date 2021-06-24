<?php

namespace app\core;

// clase especiañl para interactuar BD
abstract class DbModel extends Model{

    abstract public function tableName(): string;
    //abstract public function attributes(): array; // los framework devuelven los campos de la estructura de la tabla

    public function save(){
        
        $pdo = Application::$app->db->pdo;
        $tableName = $this->tableName();
        //$attributes = $this->attributes();
        $attributes =  $this->getAttribute($tableName); 
        var_dump ($attributes);
        exit;
        $params = array_map(fn($attr) => ":$attr", $attributes);
        

        //INSERT INTO users () VALUES (:firstName, :lastName, :email, :password, :confirmPassword) ;
        $statement = $pdo->prepare("
        INSERT INTO $tableName
                (". implode(",", $attributes) .")
        VALUES
                (". implode(",", $params) . ")
        ");

        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
            // ejemplo $statement->bindValue(":firstname", $this->firstname);
            //cambiar a bind param 
        }
        $statement->execute();
        return true;
    }

    public function getAttribute($tableName): array{
        $statement = $pdo->prepare("
                SELECT COLUMN_NAME 
                  FROM INFORMATION_SCHEMA.COLUMNS 
                 WHERE TABLE_NAME = $tableName");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
}