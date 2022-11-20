<?php
$noImage = null;
//check for upload request
if(isset($_POST['submit'])){
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];
    $newFileName = $_POST['filetitle'];
    //if image title and description are empty, give it the the title: Title and description: Description
    if(empty($newFileName || $imageTitle)){
        $imageTitle = 'Title';
        $newFileName = 'Image';
        $imageDesc = 'Description';
    }else{
        $newFileName = strtolower(str_replace(' ','-',$newFileName));
    }

    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];
    
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', '');
    //checking if extensions are allowed
    if(in_array($fileActualExt, $allowed)){
        //checking if there is an image
        if($fileError === 0){
            //checking image size
            if($fileSize < 5000000){
                $imageFullName = $newFileName . '.' . uniqid('', true). "." . $fileActualExt;
                $fileActualExt;
                $uploadDes = 'uploadFiles/'. $imageFullName;
                include_once 'dbh.inc.php';
                //if title or description are empty, send to this link
                if(empty($imageTitle || $imageDesc)){
                    header('location: index.php?upload=empty'); 
                    exit();

                }else{
                    $sql = 'SELECT * FROM gallery';
                    $stmt = mysqli_stmt_init($conn);
                    //check if connect to server failed
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo 'SQL failed';

                    }else{
                        mysqli_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $sql = 'INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);';
                         //check if connect to server failed
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo 'SQL failed';
                        }else{
                            mysqli_stmt_bind_param($stmt, 'ssss', $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                            mysqli_stmt_execute($stmt);
                            move_uploaded_file($fileTempName, $uploadDes);
                            header('location: index.php?fileuploded');
                        }
                    }
                }
                 
            }else{
                header('location: index.php?imagetoobig');
                echo ' too big';
                exit();
            }
        }else{
            header('location: index.php?noimage');
            exit();
        }

    }else{
        header('location: index.php?filetypeerorr');
        exit();
    }

}