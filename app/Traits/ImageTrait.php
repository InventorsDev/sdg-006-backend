<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use Illuminate\Support\Str;
  
trait ImageTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function imageUpload($file, $directory = 'images' ) {

        $image_name = Str::random(20);
        $ext = strtolower($file->getClientOriginalName()); // You can use also getClientOriginalName()
        $image_full_name = $image_name.'-'.$ext;
        $upload_path = $directory.'/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path.$image_full_name;
        $success = $file->move($upload_path,$image_full_name);

        return $image_url;

            // $file_name = time().'-'.$file->getClientOriginalName();
            // request()->p_image->move(public_path('post_images'), $imageName); 
  
        
  
    }

    public function imageRemoval($imagePath)
    {
        if(\File::exists(public_path($imagePath)))
        {
            \File::delete(public_path($imagePath));
        }
        return true;
    }

    public function multipleImageUpload($file_array, $directory = 'images')
    {
        $data = array();
        $i = 0;
        foreach ($file_array as $file) {
            $success = $file->move($upload_path,$image_full_name);

            array_push($data, asset($image_url));

            $i++;
        }
        return $data;

    }

  
}