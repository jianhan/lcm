<?php

namespace App\Api\V1\Controllers;

use App\Api\Requests\UploadFile;
use App\Api\V1\BaseController;
use Validator;
use function file_get_contents;

class FileController extends BaseController
{
    public function upload(UploadFile $request)
    {
        foreach ($request->files as $f) {
            $fileName = 'courses/' . time() . str_slug($f->getClientOriginalName());
            \Storage::disk('s3')->put($fileName, file_get_contents($f), 'public');
            dd($url = \Storage::disk('s3')->url($fileName));
        }
        dd(sizeof($request->files));
    }
}
