<?php

namespace App\helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class Helper 
{
    public static function dateThai($date)
    {
        return date('d/m/Y, H:i',strtotime($date));
    }
    public static function upload_image($image_file,$folder,$x,$y)
    {
        $filename = "$folder" . date('dmY-His');
        $file = $image_file;
        if ($file) 
        {
            $lg = Image::make($file->getRealPath());
            $size = $lg->filesize();
            $ext = explode("/", $lg->mime())[1];
            $lg->resize($x,$y)->stream();
            $newLG = 'uploads/'.$folder.'/' . $filename . '.' . $ext;
            $store = Storage::disk('public')->put($newLG, $lg);
            if($store)
            {
                $arr['image'] = $newLG;
                $arr['ext'] = $ext;
                $arr['size'] = $size;
            }else{
                $arr['status'] = 500;
                $arr['message'] = "Error";
            }
            return $arr;
        }
    }
}