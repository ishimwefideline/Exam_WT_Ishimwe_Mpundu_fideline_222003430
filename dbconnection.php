<?php  
$servername="localhost";
$username="mpundu";
$password="fideline";
$dbname="career_development (1)";
$connection= new mysqli($servername,$username,$password,$dbname);
if($connection->connect_error) {
	die("connection failed.".$connection->connect_error);
}
?>
