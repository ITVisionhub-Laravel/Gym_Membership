<?php

namespace App\Db\Core;
 
use app\Db\Core\ParentField;
use App\Exceptions\ErrorException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Crud
{
    public function __construct(
        private Model $model,
        private ?array $data,
        private ?int $id,
        private $editMode,
        private $deleteMode,
    ) {
        $this->model = $model;
        $this->data = $data;
        $this->id = $id;
        $this->editMode = $editMode;
        $this->deleteMode = $deleteMode;
        self::$tableName = $model->getTable();
    }

    public static string $imageDirectory = '';
    public static string $tableName = '';
    public static string $diskName = '';
    private ?Model $record = null;

    public function setImageDirectory(string $directoryPath, string $tablename, string $diskName)
    {
        self::$imageDirectory = $directoryPath;
        self::$tableName = $tablename;
        self::$diskName = $diskName;
    }

    public function getData(string $model, string $id)
    {
        $modelInstance = new $model;
        return $modelInstance->findOrFail($id);
    }

    public function execute(): mixed
    {
        try {
            if ($this->editMode) {
                return $this->handleEditMode();
            } elseif ($this->deleteMode) {
                return $this->handleDeleteMode();
            } else {
                return $this->handleStoreMode();
            }
        } catch (QueryException $e) { 
            return response($e->getMessage());
        }
    }

    protected function iterateData(array $data, ?Model $record = null): Model
    {
        $target = $record ?? $this->model;
        foreach ($data as $column => $value) {
            $target->{$column} = $this->savableField($column)->setValue($value)->execute();
            Log::error("This is savabled data");
        }
        return $target;
    }

    protected function handleStoreMode(): Model
    {
        if ($this->data) {
            $this->model = $this->iterateData($this->data, null);
            Log::error('This is stored data log');
            if ($this->model->save()) {
                return $this->model;
            } 
            // else {
            //     return response(status: 500);
            // }
        }
    }

    protected function handleEditMode(): Model
    {
        try{
            $this->record = $this->model->findOrFail($this->id);
        }catch(ModelNotFoundException){
            throw ErrorException::recordNotFoundCode(Config::get('variables.ERROR_MESSAGES.NOT_FOUND_RECORD'));
        }
        if ($this->model->getTable() === 'products' || $this->model->getTable() === 'profiles' || $this->model->getTable() === 'users' || $this->model->getTable() === 'company') {
            $this->deleteImage();
        }
        if ($this->data) {
            $record = $this->iterateData($this->data, $this->record);
            return $record->save() ? $this->record : response(status: 500);
        }
    }

    protected function handleDeleteMode()
    {
        try {
            $this->record = $this->model->findOrFail($this->id);
            return $this->record->delete() ? true : false;
        } catch (ModelNotFoundException) {
            throw ErrorException::recordNotFoundCode(Config::get('variables.ERROR_MESSAGES.NOT_FOUND_RECORD'));
        }
        
    }

    public function savableField($column): ParentField
    {  
        return $this->model->saveableFields()[$column];
    }

    public function deleteImage(): bool
    {
        $old_image = $this->record->image;
        return $old_image ? Storage::disk('spaces')->delete($old_image) : false;
    }

    public static function storeImage($value, $imageDirectory, $imageName, $diskName)
    {
        return $value->storeAs($imageDirectory, $imageName, $diskName);
    }
}
