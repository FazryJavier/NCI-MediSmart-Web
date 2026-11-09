<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Delete an uploaded file that belongs to a record. The path must come from the database,
     * never from the request, and is restricted to the upload directory (no "../").
     */
    protected function deleteStoredFile(?string $path): void
    {
        if (! $path || ! preg_match('#^file-image/[A-Za-z0-9][A-Za-z0-9._-]*$#', $path)) {
            return;
        }

        Storage::disk('local')->delete($path);
    }
}
