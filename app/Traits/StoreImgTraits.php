<?php

namespace App\Traits;

trait StoreImgTraits {

    public function storeImg($file, $path)
    {
        if($file){
            //Get filename with extention
            $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extention = $file->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Upload Image
            $path = $file->storeAs('public/'. $path .'/', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        return $fileNameToStore;
    }
}

