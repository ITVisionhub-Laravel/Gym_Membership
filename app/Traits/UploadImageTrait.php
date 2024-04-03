<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
trait UploadImageTrait
{
    public function uploadImage($request, $model, $imageDir , $imageColumn = 'image')
    {
        if ($request->hasFile($imageColumn)) {

            $destination = public_path($model->$imageColumn);

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file($imageColumn);
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/'.$imageDir.'/', $filename);
            $model->$imageColumn = $filename;
        }
    }
}
