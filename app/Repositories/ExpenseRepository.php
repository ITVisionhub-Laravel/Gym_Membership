<?php

namespace App\Repositories;

use App\Db\Core\Crud; 
use App\Exceptions\ErrorException;
use App\Contracts\ExpenseInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Container\BindingResolutionException;

class ExpenseRepository implements ExpenseInterface
{
    public function all(string $modelName)
    {
        try {
            $model = app("App\Models\\{$modelName}");
            return $model::paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
        } catch (BindingResolutionException) {
            throw ErrorException::modelNotFoundCode($modelName);
        }
    }

    public function findById(string $modelName, int $id)
    {
        try {
            $model = app("App\Models\\{$modelName}");
            return $model::find($id);
        } catch (BindingResolutionException) {
            throw ErrorException::modelNotFoundCode($modelName);
        }
    }

    public function store(string $modelName, array $data)
    {
        $model = app("App\Models\\{$modelName}");
        $crud = new Crud($model, $data, null, false, false);
        $crud->setImageDirectory("expenses", "expenses", "spaces");
        return $crud->execute();
    }

    public function update($modelName, array $data, int $id)
    {
        $model = app("App\Models\\{$modelName}");
        $crud = new Crud($model, $data, $id, true, false);
        $crud->setImageDirectory("expenses", "expenses", "spaces");
        return $crud->execute();
    }

    public function delete(string $modelName, int $id)
    {
        $model = app("App\Models\\{$modelName}");
        return (new Crud($model, null, $id, false, true))->execute();
    }
}
