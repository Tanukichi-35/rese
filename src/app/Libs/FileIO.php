<?php 

namespace App\Libs;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileIO
{
    private static $dirName = 'storeImages';

    // イメージファイルをアップロード
    public static function uploadImageFile(UploadedFile $file){
        if(env('APP_ENV') === 'production') {
            // S3バケットのstoreImageディレクトリを作成し画像を保存
            $path = Storage::disk('s3')->putFile(self::$dirName, $file, 'public');
            return Storage::disk('s3')->url($path);
        }
        else{
            // storeImageディレクトリを作成し画像を保存
            $fileName = $file->store('public/' . self::$dirName);
            return 'storage/' . self::$dirName . '/' . basename($fileName);
        }
    }

    // イメージファイルの削除
    public static function deleteImageFile($filePath){
        if(!is_null($filePath)){
            if(env('APP_ENV') === 'production') {
                // S3対応（ディレクトリ名をファイル名でアクセス）
                $fileName = explode("/", $filePath)[4];
                return Storage::disk('s3')->delete(self::$dirName.'/'.$fileName);
            }
            else{
                return Storage::delete('public/' . self::$dirName . '/' . basename($filePath));
            }
        }
    }
}