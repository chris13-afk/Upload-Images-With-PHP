<?php
include_once 'dbh.inc.php';
include_once 'functions.php';

//request to update
if(isset($_POST['update'])){

    $UpdateTitle = $_POST['filename'];
    $UpdateDesc = $_POST['desc'];
    $keyId = $_POST['id'];
    UpdateRec($conn, $keyId, $UpdateTitle, $UpdateDesc);
}

