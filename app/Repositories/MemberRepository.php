<?php

namespace App\Repositories;

use App\DB\Core\Crud; 
use App\Contracts\MemberInterface;
use App\Exceptions\ErrorException; 
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Container\BindingResolutionException;

class MemberRepository implements MemberInterface
{
    public function getModelInstance(string $modelName): Model
    {
        return app("App\Models\\{$modelName}");
    }
    
    public function all(string $modelName)
    {  
        try { 
            return $this->getModelInstance($modelName)::with('address.street.ward.township.city.state.country')
                        ->where('role_as', 0)
                        ->paginate(Config::get('variables.NUMBER_OF_ITEMS_PER_PAGE'));
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
        $crud->setImageDirectory("users", "users", "spaces");
        return $crud->execute();
    }

    public function update($modelName, array $data, int $id, String $updateColumnField = null)
    { 
        if($updateColumnField != null){  
            $crud = new Crud($this->getModelInstance($modelName), $data, $id, true, false, $updateColumnField);
        } else{
            $crud = new Crud($this->getModelInstance($modelName), $data, $id, true, false);
        }
        
        $crud->setImageDirectory("users", "users", "spaces");
        return $crud->execute();
    }

    public function delete(string $modelName, int $id)
    {
        $crud = new Crud($this->getModelInstance($modelName), null, $id, false, true);
        $crud->setImageDirectory("users", "users", "spaces");
        return $crud->execute();
    }
}
