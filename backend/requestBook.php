<?php

session_start();
include '../backend/dbconnect.php';
$conn = OpenCon(); 


// initializing variables
$book_name = "";
$author_name    = "";
$book_id    = "";
$errors = array(); 
$data = array(); 


// request for book
if (isset($_POST['RequestBook'])) {
  // receive all input values from the form
  $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
  $author_name = mysqli_real_escape_string($conn, $_POST['author_name']);
  $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
  $email = $_SESSION['email'];
  if (empty($book_name)) {$errors["book_name"] = "Book name is required"; }else{
    $data['book_name']=$book_name;
  }
  

  if (count($errors) == 0) {
  	
  	$query = "INSERT INTO request_book (book_id,book_name,author_name, email) 
  			  VALUES('$book_id','$book_name','$author_name','$email')";
  	mysqli_query($conn, $query);
    header("Location: http://localhost/bookstore/pages/requestforbook.php?success=true");
  }else{
    print_r($errors);
    $errors = urlencode(serialize($errors));
    $data = urlencode(serialize($data));
    header("Location: http://localhost/bookstore/pages/requestforbook.php?err=$errors&&data=$data");
  }
}