<?php

namespace app\core\widgets;

use app\core\Model;

class Form{
    public static function begin($action, $method){
        //return sprintf('<form action="%s" method="%s">', $action, $method);
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }
    public static function end(){
        echo '</form>';
    }
    //Polimorfismo
    public function field(Model $model, string $attribute){
        return new Field($model, $attribute);
    }
}