<?php

namespace App\Db\Core;

class StringField extends ParentField
{
    public function execute()
    {
        return $this->value;
    }
}
