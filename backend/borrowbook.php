<?php
session_start();
if(!isset($_SESSION['email'])){
  echo "login";
}else{
  
  include '../backend/dbconnect.php';
  $conn = OpenCon(); 

  $book_name = mysqli_real_escape_string($conn, $_POST['data'][0]);
  $email = $_SESSION['email'];
  $Today=date('y:m:d');
  $last_date = date('Y-m-d', strtotime($Today. ' + 10 days')); 
  $query = "INSERT INTO borrow_book (book_name, email,last_date) 
        VALUES('$book_name','$email','$last_date')";
  mysqli_query($conn, $query);

}