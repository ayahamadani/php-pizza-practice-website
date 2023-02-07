<?php 

 // connect to database
 $conn = mysqli_connect('localhost', 'Aya', 'VqsrVXTKxaDx.4z', 'aya_pizza');

 // check the connection
if(!$conn){
       echo 'Connection error: ' . mysqli_connect_error();
}

?>