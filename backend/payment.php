<?php

use function PHPSTORM_META\type;

session_start();
include '../backend/dbconnect.php';
$conn = OpenCon(); 


if (isset($_POST['payment'])) {
  print_r($_POST);
  
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $full_address = $address.",".$state.",".$zip.",".$country.".";
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $orderId = mysqli_real_escape_string($conn, $_POST['orderId']);
    $books = mysqli_real_escape_string($conn, $_POST['bookList']);
    $delivery_type = mysqli_real_escape_string($conn, $_POST['delivery_type']);
    if($delivery_type=="digital"){
      $delivery = "Payment Done";
    }else{
      $delivery = "Cash On Delivery";      
    }
    $books = json_decode(str_replace("\\","",$books));
    $total=0;
    
    foreach($books as $book){
      $total+=((int)$book->price*(int)$book->count);
      $name =stripslashes(str_replace("_"," ",$book->name));
      $query = "INSERT INTO `orders` (`book_name`, `quantity`, `price`, `status`, `order_id`, `user_email`)     
      VALUES ('$name',$book->count,'$book->price', '$delivery','$orderId','$email')";      
      mysqli_query($conn, $query);
      $query = "SELECT `quantity` from `books` WHERE id = '$book->id'";  
      $result = mysqli_query($conn, $query);
      $quntity_db = $result->fetch_assoc()['quantity']; 
       $updateQuantity = (int)$quntity_db-(int)$book->count;
      $query = "UPDATE `books` SET `quantity`='$updateQuantity' WHERE id = '$book->id'"; 
      echo $query;     
      mysqli_query($conn, $query);
    }
    
    $query = "INSERT INTO `payment` (`amount`, `order_id`)     
      VALUES ('$total','$orderId')";      
      mysqli_query($conn, $query);
    
    
    $query = "INSERT INTO `shipping` (`f_name`, `l_name`, `address`, `order_id`)     
      VALUES ('$f_name','$l_name','$full_address','$orderId')";      
      mysqli_query($conn, $query);
    
    header("Location: /bookstore/pages/payment.php");

  }