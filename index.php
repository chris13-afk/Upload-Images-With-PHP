<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP Image Gallery</title>
</head>
<body>
  <h1>Image Gallery</h1>
  <section class="galler-container">
    <?php

      include_once 'dbh.inc.php';
      include_once 'functions.php';
      
      $sql = 'SELECT * FROM gallery ORDER BY orderGallery DESC';
      $stmt = mysqli_stmt_init($conn);
      
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo 'SQL failed';

      }else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
        
        echo '
    
        <form action="update.php" method="post" enctype="multipart/form-data">
        
          <div class="imgDisplay">

            <input type="hidden" name="id" value='.$row['idGallery'].'>

            <a class="fa-regular fa-circle-xmark xMark " name="idGallery" value='.$row['idGallery'].' href="delete.php?keyId='.$row['idGallery'].'"></a>

            <div class="imgHolder">
              <img class="displayImage" src="uploadFiles/'.$row['imgFullNameGallery'].'";"></img>
            </div>

            <div class="updateHolder">
        
              <input 
              spellcheck="false"
              type="text" 
              name="filename" 
              value='.$row['titleGallery'].' 
              class="title updateInput" 
              disabled="disabled" 
              maxLength="13"
              data-tId='.$row['idGallery'].'
              >

              <a class="fa-solid fa-pen-to-square editIcon" data-pen='.$row['idGallery'].'> </a>

              <button type="submit" name="update" class="fa-regular fa-circle-check vis greenCheck hide" data-gId='.$row['idGallery'].'></button>
              
              <span class="titleNumber  hide" data-cId='.$row['idGallery'].'>13/13</span>

              <input 
              type="text" 
              spellcheck="false" 
              name="desc" 
              value='.$row['descGallery'].' 
              class="desc updateInput" 
              disabled="disabled" 
              maxLength="13" 
              data-dId='.$row['idGallery'].'>

              <span class="descNumber hide " data-sId='.$row['idGallery'].'>13/13</span>

            </div>
          </div>
        </form>
        
      ';
        
      }
    }
    ?>
  </section>
  
    <div class="popUpImage hide">
      <i class="fa-solid fa-x imgExit"></i>
      <i class="fa-solid fa-chevron-left left" data-button="prev"></i>
      <i class="fa-solid fa-chevron-right right" data-button="next"></i>
      <div class="popup">
        <img data-active class="popUpImg" src="">
        <span class="hh"></span>
      </div>
    </div>
  

  <?php
    include_once 'gallery-upload.php';
    $url = "http//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $checkImags = mysqli_num_rows($result);
    if($checkImags >= "6" ){
      echo '
      <div class="fileInput" >
        <h3>Your upload limit has been reached.<br/> <br/> Please delete to Upload more images.</h3>
      </div>
      ';
    }else{
      echo '
      <div class="fileInput" >
      <form action="gallery-upload.php" method="POST" enctype="multipart/form-data">
        <input maxLength="10" type="text" name="filetitle" placeholder=" Image Title">
        <input maxLength="10" type="text" name="filedesc" placeholder=" Image Description">
        <input type="file" name="file" id="file">
        '.((strpos($url,"noimage") == true)? "<p class='erorr'>no image was chosen</p>":"").'
        '.((strpos($url,"imagetoobig") == true)? "<p class='erorr'>file size too big</p>":"").'
        '.((strpos($url,"filetypeerorr") == true)? "<p class='erorr'>file type not allowed</p>":"").'
        '.((strpos($url,"fileuploded") == true)? "<p class='success'>image upload</p>":"").'
        <button type="submit" name="submit">Upload</button>
      </form>
    </div>
      ';
   
      } 
  
     
?>

  <script src="js.js"></script>
</body>
</html>