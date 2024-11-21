<?php
include("../includes/connectdb.php");

//Function to get the existing image or default image
function getImageData($connection, $product_id, $defaultImagePath) {
        //Query to get the current image for the product
        $imageQuery = "SELECT image FROM products WHERE product_id = $product_id";
        $imageResult = mysqli_query($connection, $imageQuery);  
        if ($imageResult && $existingImage = mysqli_fetch_assoc($imageResult)['image']) {
                return $existingImage; //returns existing image if found
        }

        //check if default image exists
        if (file_exists($defaultImagePath)) {
                return addslashes(file_get_contents($defaultImagePath));
        } else {
                die("Default image not found.");
        }
}


?>