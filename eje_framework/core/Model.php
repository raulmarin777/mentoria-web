<?php

namespace app\core;

// self hace referencias a la clase y solo se usa en la clase
// this a los atributos de la clase, se puede utilizar en todos lados

abstract class Model{

    public const RULE_REQUIRED = 'requered';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public $errors = [];

    public function loadData($data){
        foreach ($data as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate(){
        foreach ($this->rules() as $attribute => $rules){
            $value = $this->$attribute; 
            foreach($rules as $rule){
                $rulename = $rule;
                if (!is_string($rulename)){
                    $rulename = $rule[0];
                }

                if ($rulename === self::RULE_REQUIRED && !$value){
                    // agregar Error
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if ($rulename === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                
                if ($rulename === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($rulename === self::RULE_MAX && strlen($value) < $rule['max']){
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if ($rulename === self::RULE_MATCH && $value != $this->{$rule['mach']}){
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        return empty($this->errors);
    }
    public function addError($attribute, $rule, $params = []){
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $param){
            $message= str_replace ("{{$key}}", $param, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(){
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be an email',
            self::RULE_MIN => 'Min length of the field must be {min}',
            self::RULE_MAX => 'Max length of the field must be {max}',
            self::RULE_MATCH => 'This fiels must be the same as {attribute}',
        ];
    }

}
