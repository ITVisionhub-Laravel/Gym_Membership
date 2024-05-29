<?php

namespace App\DB\Core;

class IntegerField extends ParentField
{
    public function execute()
    {
        return $this->value;
    }
}
