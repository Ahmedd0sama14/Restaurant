<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{

    public function handleFile(UploadedFile $file, ?string $oldFile = null, string $folder ): string
    {
        $this->deleteOldFile($oldFile);
        return $file->store($folder, 'public');
    }


    public function handleMultipleFiles(array $files, array $oldFiles = [], string $folder ): array
    {
        $newFiles = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $newFiles[] = $file->store($folder, 'public');
            }
        }

        $this->deleteMultipleFiles($oldFiles);

        return $newFiles;
    }
    public function deleteOldFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    public function deleteMultipleFiles(array $files): void
    {
        foreach ($files as $file) {
            $this->deleteOldFile($file);
        }
    }
}
