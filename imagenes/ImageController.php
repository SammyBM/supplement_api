<?php

/**
 * @param string $imageName hashed file name.
 * @param string $imagePath folder path where to store the image.
 * @param string $bitmap binary data representing the picture.
 */
function uploadProductImage($imageName, $imagePath, $bitmap)
{
    try {
        $real_path = hash("md5", $imageName) . ".jpg";
        file_put_contents($real_path, $bitmap);
        return true;
    } catch (Exception $error) {
        var_dump($error);
        return false;
    }
}
function getProductImage($imageName, $imageSrc)
{
    include '../config/ROUTE.php';
    try {
        file_get_contents("imagenes_carrousel/" . $imageName, $imageSrc);
    } catch (Exception $error) {
        var_dump($error);
        return false;
    } finally {
        return true;
    }
}
