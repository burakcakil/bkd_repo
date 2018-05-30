<?php
include("../db/db_conf.php");

$eposta = $_GET['email'];
$foto_target_dir = "../uploads/fotograf/";
$ozgecmis_target_dir = "../uploads/ozgecmis/";
error_log(print_r($_FILES["fotograf"],true),0);
$foto_real_name = "fotograf".md5($eposta)."." . get_extension(basename($_FILES["fotograf"]["name"]));
$ozgecmis_real_name = "ozgecmis_".md5($eposta)."." . get_extension(basename($_FILES["ozgecmis"]["name"]));
$foto_target_file = $foto_target_dir . $foto_real_name;
$ozgecmis_target_file = $ozgecmis_target_dir .$ozgecmis_real_name;
error_log($foto_target_file,0);
error_log($ozgecmis_target_file,0);
$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
/*if (file_exists($foto_target_file)) {
    error_log("Sorry, file already exists.",0);
    $uploadOk = 0;
}*/
// Check file size
if ($_FILES["fotograf"]["size"] > 3000000) {
    error_log( "Sorry, your file is too large.",0);
    $uploadOk = 0;
}
// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    error_log( "Sorry, your file was not uploaded.",0);
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fotograf"]["tmp_name"], $foto_target_file) && move_uploaded_file($_FILES["ozgecmis"]["tmp_name"], $ozgecmis_target_file)) {
        error_log( "The files have been uploaded.",0);
        db_query("UPDATE ybi_basvuru SET FOTO_PATH = '$foto_real_name', CV_PATH = '$ozgecmis_real_name' WHERE EPOSTA = '$eposta' AND BASV_YIL = (SELECT value FROM ybi_aktif_yil)");
        error_log("File names have been updated");
        echo "OK";
    } else {
        error_log( "Sorry, there was an error uploading your files.",0);
        echo "ERROR";
    }
}


function get_extension($file) {
 $extension = end(explode(".", $file));
 return $extension ? $extension : false;
}

 ?>
