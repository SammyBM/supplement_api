<?php
    function uploadimage($imageName,$imageSrc){
        include 'config/ROUTE.php';
        try{
            file_put_contents("/imagenes/".$imageName, $imageSrc);
        }catch(Exception $error){
            var_dump( $error);
            return false;
        }finally{
            return true;
        }
    }