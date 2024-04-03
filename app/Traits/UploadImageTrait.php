<?php

namespace App\Traits;

trait UploadImageTrait
{
    public function uploadImage($request, $model, $imageDir)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/'.$imageDir.'/', $filename);
            $model->image = $filename;
        }
    }
}
