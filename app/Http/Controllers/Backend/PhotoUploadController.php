<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoUploadController extends Controller
{
    public function imageUpload(string $name, int $height, int $width, string $path, $file)
    {
        $image_name = $name . '.webp';
    }
}
