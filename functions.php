<?php
include_once 'gallery-upload.php';
include_once 'dbh.inc.php';

//delete image functionn
function deleteRec($conn, $keyId){
    $sqlDelete = 'DELETE FROM gallery WHERE idGallery="'.$keyId.'"';
    $result = $conn->query($sqlDelete);

    header('location: index.php?deleted'); 
    exit();

    if(!$result){
        echo 'can not delete'; 
    } 

}

//update then name of the image
function UpdateRec($conn, $keyId, $UpdateTitle, $UpdateDesc){

    if($keyId && $UpdateTitle){
        $sqlUpdate  = "UPDATE gallery SET titleGallery='$UpdateTitle', descGallery='$UpdateDesc' WHERE idGallery='$keyId'";
        $result = mysqli_query($conn, $sqlUpdate);

        header('location: index.php?updated');
        }    

    if($result){
        echo ' '  .$keyId. ' ';
        echo ' '  .$UpdateTitle. ' ';
        echo ' '.$result.' ';
        
    }

}
