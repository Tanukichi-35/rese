<?php 

namespace App\Libs;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileIO
{
    private static $dirName = 'storeImages';

    // イメージファイルをアップロード
    public static function uploadImageFile(UploadedFile $file){
        // storeImageディレクトリを作成し画像を保存
        $fileName = $file->store('public/' . self::$dirName);
        return 'storage/' . self::$dirName . '/' . basename($fileName);
    }

    // イメージファイルの削除
    public static function deleteImageFile($filePath){
        if(!is_null($filePath)){
            return Storage::delete('public/' . self::$dirName . '/' . basename($filePath));
        }
    }
}