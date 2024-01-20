<?php



class Image{


    public function crop($image_path,$dest_image_path,$max_size=600){
       
        if(file_exists($image_path)){

            $ext=strtolower(pathinfo($image_path,PATHINFO_EXTENSION));
      
            if($ext=='jpeg' ||$ext=='jpg'){
                $src_image=imagecreatefromjpeg($image_path);

            }else if($ext=='png'){
                $src_image=imagecreatefrompng($image_path);
            }
            if($image_path){
                $width=imagesx($src_image);
                $height=imagesy($src_image);

                if($width>$height){
                    $extra_space=$width-$height;
                    $src_x=$extra_space/2;
                    $src_y=0;
                    $src_w=$height;
                    $src_h=$height;

                }else{
                    $extra_space=$height-$width;
                    $src_y=$extra_space/2;
                    $src_x=0;
                    $src_w=$width;
                    $src_h=$width;;

                }
                $image_to_insert=imagecreatetruecolor($max_size,$max_size);

                imagecopyresampled($image_to_insert,$src_image,0,0,$src_x,$src_y,$max_size,$max_size,$src_w,$src_h);
                imagejpeg($image_to_insert,$dest_image_path);

            }

        }
    }

    public function profile_thumb($image_path){
         $crop_size=600;
         $ext=strtolower(pathinfo($image_path,PATHINFO_EXTENSION));
         $thumbnail=str_replace('.'.$ext,'_thumb.'.$ext,$image_path);
   
        if(!file_exists($thumbnail)) {
            
            $this->crop($image_path,$thumbnail, $crop_size);   
        }
        return str_replace('../private/uploads/',DOWNLOAD,$thumbnail);
        ;
    }
}