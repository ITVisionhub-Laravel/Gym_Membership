<?php

namespace App\Repositories;
use App\DB\Core\Crud;
use App\Exceptions\ErrorException;
use App\Contracts\LocationInterface;
use Illuminate\Support\Facades\Config;  
use Illuminate\Contracts\Container\BindingResolutionException;

class LocationRepository implements LocationInterface
{
    public function all(string $modelName)
    {
        try{
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
        try {
            $model = app("App\Models\\{$modelName}"); 
            return (new Crud($model,$data,null,false,false))->execute();
        } catch (BindingResolutionException) { 
            throw ErrorException::modelNotFoundCode($modelName);
        } 

    }

    public function update(string $modelName, array $data, int $id)
    {
        try{
            $model = app("App\Models\\{$modelName}");
            return (new Crud($model,$data,$id,true,false))->execute();
        } catch (BindingResolutionException) { 
            throw ErrorException::modelNotFoundCode($modelName);
        } 
    }

    public function delete(string $modelName, int $id)
    {
        try{
            $model = app("App\Models\\{$modelName}");
            return (new Crud($model,null,$id,false,true))->execute();
        } catch (BindingResolutionException) { 
            throw ErrorException::modelNotFoundCode($modelName);
        }
    }
}
