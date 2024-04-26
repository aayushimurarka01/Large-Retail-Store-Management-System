<?php
$serverame="localhost:3307";
$username="root";
$password="";
$db_name="storemanagement";

//Create a Connection
$conn=mysqli_connect($serverame,$username,$password,$db_name);

if(!$conn){
    die("Failed to connect:". mysqli_connect_errot());
}
/*else{
    echo "Connection was successful";
}*/
?>