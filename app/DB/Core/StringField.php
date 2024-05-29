<?php

namespace App\DB\Core;

class StringField extends ParentField
{
    public function execute()
    {
        return $this->value;
    }
}
