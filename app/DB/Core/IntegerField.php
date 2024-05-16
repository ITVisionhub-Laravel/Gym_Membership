<?php

namespace App\Db\Core;

class IntegerField extends ParentField
{
    public function execute()
    {
        return $this->value;
    }
}
