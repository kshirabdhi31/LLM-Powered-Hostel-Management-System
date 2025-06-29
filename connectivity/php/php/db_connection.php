<?php
$host='localhost';
$user='root';
$pass='';
$db='hostel_mangement_system';
$conn=new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    echo"failed to connect db".$conn->connect_error;
}
?>