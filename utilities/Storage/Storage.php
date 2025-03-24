<?php

namespace Utils\Storage;
class Storage
{
    public static function store($file)
    {

        $image_type = exif_imagetype($file["tmp_name"]);
        if (!$image_type) {
            header('location: /profile?fail=image');
        }

        $image_extension = image_type_to_extension($image_type, true); // this method help to get the file extension 
                                                                // and preprend a '.' at the begining (true)
        $image_name = bin2hex(random_bytes(16)) . $image_extension;

        
        move_uploaded_file( 
            $file["tmp_name"],

            "assets/storage/" . $image_name
        ); // Moving the file to the image directory

        return $image_name;
    }

    public static function getUrl(string $path)
    {
        return "storage/" . $path;
    }  
}
