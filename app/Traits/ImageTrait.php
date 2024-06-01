<?php
namespace app\Traits;
use Illuminate\Support\Facades\File;

Trait ImageTrait
{
    function saveFile($image,$folder)
    {   //dd($image);
        if ($image) {
            $fileName = time() . 'Traits' . $image->getClientOriginalExtension();
            $destinationPath = public_path($folder);
            $image->move($destinationPath, $fileName);
            return $fileName;
        }
        return null;
    }
}
