<?php

namespace app\models;

use app\core\DbModel;

class RegisterModel extends DbModel {
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName():string{
        return 'users2';
    }

    public function schemaName():string{
        return 'registro';
    }

    public function save(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN,'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH,'match' => 'password']],
        ];
    }

    /*public function attributes(): array{
        return[
            'firstName',
            'lastName',
            'email',
            'password'
        ]; // se deben sacar de la bd https://thispointer.com/mysql-get-column-names/

    }*/
}