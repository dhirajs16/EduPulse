<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait FileUpload {

    function handleUploadFile (UploadedFile $file, string $dir = 'uploads', string $disk = 'public_uploads') {

        // Handle disk type
        if(!in_array($disk, ['local', 'public', 'public_uploads'])) {
            throw new Exception("Invalid disk type. Must be either local or public");
        }

        // Handle file upload
        try {
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs($dir, $filename, $disk);
            return "/$dir/$filename";
        } catch (\Throwable $th) {
            throw $th;
        }

        return null;
    }


    function handleDeleteFile (string $filePath, string $disk = 'public_uploads') : bool {
        // Handle disk type
        if(!in_array($disk, ['local', 'public', 'public_uploads'])) {
            throw new Exception("Invalid disk type. Must be either local or public");
        }

        // Handle file deletion
        if($disk === 'public_uploads') {
            if(File::exists(public_path($filePath))) {
                File::delete(public_path($filePath));
                return true;
            }
        }else {
            if(File::exists(storage_path($filePath))) {
                File::delete(storage_path($filePath));
                return true;
            }
        }

        return false;
    }
}
