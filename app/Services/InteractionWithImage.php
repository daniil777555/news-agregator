<?php declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InteractionWithImage
{
    public function storeImage(Request $request)
    {
        if($request->hasFile("images") && !is_null($request->file("images"))){
            $image = $request->file("images");
            $extension = $image->getClientOriginalExtension();
            $name = now() . "." . $extension;

            return $image->storeAs("newsImages", $name, "public");
        }
        return null;
    }

    public function deleteImages(array $imageArray)
    {
        foreach($imageArray as $imageName){
            if(Storage::disk('public')->exists($imageName)){
                Storage::disk('public')->delete($imageName);
            }
        }
    }

    public function deleteImage(string $imageName)
    {
        if(Storage::disk('public')->exists($imageName)){
            Storage::disk('public')->delete($imageName);
        }
    }
}
