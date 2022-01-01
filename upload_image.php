<?php

$temp_path = realpath(dirname(__FILE__)) . '/images/temp/';

$final_path = realpath(dirname(__FILE__)) . '/images/blog/';

$temp_img_name = 'current_image.png';

$response = "";

// Check local directory
if (!file_exists($temp_path)){
    echo "Unable to find the temp path!<br>";
    http_response_code(400);
    die();
}

// Check final directory
if (!file_exists($final_path)){
    echo "Unable to find the destination path!<br>";
    http_response_code(400);
    die();
}

//Check if user has put the name
if (isset($_POST["image_name"]) && $_POST["image_name"] != "") {
    $image_name = $_POST["image_name"];
    $final_image = $final_path .  $image_name . '.webp';
} else {
    echo "You haven't put the name for an image!";
    http_response_code(400);
    die();
}

$temp_image = $temp_path . $temp_img_name;

//Remove old image

if(file_exists($temp_image)) {
    chmod($temp_image,0755); //Change the file permissions if allowed
    unlink($temp_image); //remove the file
}
$handle = fopen($temp_image, 'w') or die('Cannot open file:  ' . $temp_image); //implicitly creates file
fclose($handle);
chmod($temp_image,0755); //Change the file permissions if allowed

//Upload a temp image

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES['file']['tmp_name']);
if($check !== false) {
    move_uploaded_file($_FILES['file']['tmp_name'], $temp_image);
    $uploadOk = 1;
} else {
    echo "File is not an image.<br>";
    $uploadOk = 0;
    http_response_code(400);
    die();
}

if (!file_exists($temp_image)){
    echo "Cannot find a file to convert!<br>";
    http_response_code(400);
}

// Convert to a webp

if(exif_imagetype($temp_image) == IMAGETYPE_JPEG) {
    if (!imagewebp(imagecreatefromjpeg($temp_image), $final_image, 100)){
        echo "Cannot convert to a webp!";
        http_response_code(500);
    }
}

if(exif_imagetype($temp_image) == IMAGETYPE_PNG) {
    if (!imagewebp(imagecreatefrompng($temp_image), $final_image, 100)){
        echo "Cannot convert to a webp!";
        http_response_code(500);
    }
}

if (file_exists($final_image)){
    $abs_path = "../images/blog/$image_name" . ".webp";
    echo json_encode(array("message" => "File converted successfully", "image_path" => "$abs_path"));
    http_response_code(200);
} else {
    echo "File doesn't exist after conversion!<br>";
    http_response_code(500);
}

?>