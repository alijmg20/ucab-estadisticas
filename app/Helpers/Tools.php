<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
class Tools {

    public static function StorageUrl($url) {
        return Storage::url($url);
    }

    public static function DeleteStorageUrl($url) {
        return Storage::delete($url);
    }
    
}