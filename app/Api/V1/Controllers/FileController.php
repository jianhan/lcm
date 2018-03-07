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
        $file = $request->get('file');
        $uuid = $request->get('uuid', false);
        $fileName = $request->get('dir') . time() . str_slug($file->getClientOriginalName());
        \Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');
        $url = \Storage::disk('s3')->url($fileName);
        return response()->json([
            'url' => $url,
            'uuid' => $uuid,
        ]);
    }
}
