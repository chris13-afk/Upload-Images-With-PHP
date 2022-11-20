<?php
include_once 'dbh.inc.php';
include_once 'functions.php';

$keyId = '';

//delete image from database
if(!empty($_GET['keyId'])){
    $keyId = $_GET['keyId'];
    deleteRec($conn, $keyId);
}if(empty($idkey)){
    echo 'not found'; 
}