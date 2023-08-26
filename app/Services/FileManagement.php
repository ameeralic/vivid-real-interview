<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileManagement
{
    public function uploadFile(
        string $path,
        $file = null,
        array $files = null,
        array $appendFilesTo = array(), bool $deleteOldFile = false, string $oldFile = null, string $storeAsName = '') {
        if (!empty($files)) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    array_push($appendFilesTo, $file->store($path));
                } else {
                    array_push($appendFilesTo, $file);
                }
            }
            return $appendFilesTo;

        } else if (is_file($file)) {
            if (!empty($file) && !empty($file->extension() ?? '') && is_file($file)) {
                if ($deleteOldFile) {
                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::delete($oldFile);
                    }
                }
                if (empty($storeAsName)) {
                    $storeAsName = $file->getClientOriginalName();
                } else {
                    $storeAsName = $storeAsName . '.' . $file->extension();
                }
                return $file->storeAs($path, $storeAsName);
            }
        } else {
            if (Storage::disk('public')->exists($file) || (parse_url($file)['host'] === 'images.pexels.com')) {
                return $file;
            } else {
                dd('No file/files given to uploadFile() in FileManagement Service!');
                return '';
            }
        }
    }

    public function deleteFile(string $fileUrl, array $oldFilesArray = array())
    {
        if (isset(parse_url($fileUrl)['host'])) {
            $extFileLink = $fileUrl;
        }
        // dd(Storage::disk('public')->exists($fileUrl));
        // parse_url($fileUrl)['host'] ?  parse_url($fileUrl)['host'] === 'images.pexels.com' ? $file = $fileUrl : $file = substr(parse_url($fileUrl)['path'], 1);
        // dd('app/public'.parse_url($fileUrl)['path']);
        // dd(Storage::disk('public')->exists($fileUrl));

        if (!empty($oldFilesArray)) {
            if (($key = array_search($extFileLink, $oldFilesArray)) !== false) {
                unset($oldFilesArray[$key]);
                if (!isset(parse_url($fileUrl)['host'])) {
                    Storage::disk('public')->delete($fileUrl);
                }
            }
            $newFiles = array_values($oldFilesArray);
            return $newFiles;
        } else {
            if (Storage::disk('public')->exists($fileUrl)) {
                Storage::disk('public')->delete($fileUrl);
            }
            $newFile = '';
            return $newFile;
        }
    }

    public function moveFiles(string $oldPath, string $newPath, string $deleteDirectory = '')
    {
        Storage::disk('public')->move($oldPath, $newPath);
        if (!empty($deleteDirectory)) {
            Storage::disk('public')->deleteDirectory($deleteDirectory);
        }
    }
}
