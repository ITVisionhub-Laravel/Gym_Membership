<?php

namespace App\Repositories;

use App\DB\Core\Crud; 
use App\Exceptions\ErrorException;
use App\Contracts\ExpenseInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Container\BindingResolutionException;

class ExpenseRepository implements ExpenseInterface
{
    public function getModelInstance(string $modelName): Model
    {
        return app("App\Models\\{$modelName}");
    }
    
    public function all(string $modelName)
    {
        try { 
            return $this->getModelInstance($modelName)::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
        } catch (BindingResolutionException) {
            throw ErrorException::modelNotFoundCode($modelName);
        }
    }

    public function findById(string $modelName, int $id)
    {
        try {
            return $this->getModelInstance($modelName)::find($id);
        } catch (BindingResolutionException) {
            throw ErrorException::modelNotFoundCode($modelName);
        }
    }

    public function store(string $modelName, array $data)
    { 
        $crud = new Crud($this->getModelInstance($modelName), $data, null, false, false);
        $crud->setImageDirectory("expenses", "expenses", "spaces");
        return $crud->execute();
    }

    public function update($modelName, array $data, int $id)
    { 
        $crud = new Crud($this->getModelInstance($modelName), $data, $id, true, false, 'invoice_slip');
        $crud->setImageDirectory("expenses", "expenses", "spaces");
        return $crud->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud($this->getModelInstance($modelName), null, $id, false, true, 'invoice_slip'))->execute();
    }
}
