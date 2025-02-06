<?php

session_start();
require_once 'dbcon/config.php';
include_once 'dbcon/DBConnection.php';

$dbobj = new DBConnection();
$dbobj->connect();

$heid = $_POST["heid"]; // Get the  heid from the form

if ($heid > 0) {
    $fileName = $_FILES['imagefile']['name'];
    $extenimg = $dbobj->getExtention($fileName);
    $extphoto = strtolower($extenimg);
    $newnm = $heid . "." . $extphoto;
  $upload_file = "uploads/" . $newnm;


    if (strlen($fileName) > 0) {
        move_uploaded_file($_FILES['imagefile']['tmp_name'], $upload_file);
        $result = array("status" => 1, "msg" => "Successfully updated profile image", "filename" => $upload_file);
    } else {
        $result = array("status" => 0, "msg" => "File name is empty.");
    }
} else {
    $result = array("status" => 0, "msg" => "Invalid employee ID.");
}

echo json_encode($result);
?>