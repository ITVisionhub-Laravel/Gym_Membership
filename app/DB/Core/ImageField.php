<?php

namespace App\DB\Core;

use App\DB\Core\Crud;
use Illuminate\Support\Facades\Storage;

class ImageField extends ParentField
{
    public $tableName, $imageDirectory, $diskName;

    public function __construct()
    {
        $this->tableName = Crud::$tableName;
        $this->imageDirectory = Crud::$imageDirectory;
        $this->diskName = Crud::$diskName;
    }

    public function execute()
    {
        if (!$this->value) {
            return null;
            // return response()->json([
            //   "message" => "No Data Found"
            // ]);
        }

        $uploadedFile = $this->value;
        if (!is_string($uploadedFile)) {
            $imageName = round(microtime(true) * 1000)  . '.' . $uploadedFile->extension();
            $finalImagePath = Crud::storeImage($uploadedFile, $this->imageDirectory, $imageName, $this->diskName);
            $this->value = Storage::disk('spaces')->url($finalImagePath);
        }
        return $this->value;
    }
}
