<?php

namespace App\Db\Core;

abstract class ParentField
{
    public $value = '';
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    //to instantiate objects of the class
    public static function new()
    {
        return new static;
    }

    // blueprint for subclasses to define their own implementation
    abstract public function execute();
}
