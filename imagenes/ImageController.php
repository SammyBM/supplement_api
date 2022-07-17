<?php
    function uploadProductImage($imageName,$imageSrc,$id){
        include '../config/ROUTE.php';
        try{
            $image=base64_decode('#^data:image/\w+;base64,#i', '', $imageSrc);
            $real_path="/user_images/$id.php";
            file_put_contents($real_path, $image);
        }catch(Exception $error){
            var_dump( $error);
            return false;
        }finally{
            return true;
        }
    }
    function getProductImage($imageName,$imageSrc){
        include '../config/ROUTE.php';
        try{
            file_get_contents("imagenes_carrousel/".$imageName, $imageSrc);
        }catch(Exception $error){
            var_dump( $error);
            return false;
        }finally{
            return true;
        }
    }