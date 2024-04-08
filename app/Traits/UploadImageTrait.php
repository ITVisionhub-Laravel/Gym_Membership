<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    public function uploadImage($request, $model, $imageDir, $imageColumn = 'image')
    {
        if ($request->hasFile($imageColumn)) {
            $file = $request->file($imageColumn);
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            // Store the file in DigitalOcean Spaces
            $path = $file->storeAs('uploads/' . $imageDir, $filename, 'spaces');

            if ($path) {
                // Delete the old image if it exists
                if ($model->$imageColumn) {
                    Storage::disk('spaces')->delete($model->$imageColumn);
                }

                // Update the image column with the new filename
                $model->$imageColumn = $path;
            }
        }
    }

    public function deleteImage($model, $imageColumn = 'image'): bool
    {
        if ($model->$imageColumn) {
            return Storage::disk('spaces')->delete($model->$imageColumn);
        }

        return false;
    }
}



// namespace App\Traits;

// use Illuminate\Support\Facades\File;
// trait UploadImageTrait
// {
//     public function uploadImage($request, $model, $imageDir , $imageColumn = 'image')
//     {
//         if ($request->hasFile($imageColumn)) {

//             $destination = public_path($model->$imageColumn);

//             if (File::exists($destination)) {
//                 File::delete($destination);
//             }

//             $file = $request->file($imageColumn);
//             $ext = $file->getClientOriginalExtension();
//             $filename = time() . '.' . $ext;
//             $file->move('uploads/'.$imageDir.'/', $filename);
//             $model->$imageColumn = $filename;
//         }
//     }
// }
