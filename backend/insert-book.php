<?php

include '../backend/dbconnect.php';
$conn = OpenCon(); 

// initializing variables
$bookname = "";
$authorName    = "";
$category    = "";
$year    = "";
$discount    = "";
$errors = array(); 
$data = array(); 


// REGISTER USER
if (isset($_POST['insert_book'])) {
  // receive all input values from the form
  $bookname = mysqli_real_escape_string($conn, $_POST['book_name']);
  $authorName = mysqli_real_escape_string($conn, $_POST['author_name']);
  $category = mysqli_real_escape_string($conn, $_POST['category']);
  $year = mysqli_real_escape_string($conn, $_POST['year']);
  $discount = mysqli_real_escape_string($conn, $_POST['discount']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
  

  if (empty($bookname)) {$errors["book_name"] = "Book name is required"; }else{
    $data['book_name']=$bookname;
  }
  if (empty($authorName)) { $errors["author_name"] ="Author Name is required"; }else{
    $data['author_name']=$authorName;
  }
  if (empty($category)) { $errors["category"] ="Category is required"; }else{
    $data['category']=$category;
  }
  if (empty($year)) { $errors["year"] ="Year is required"; }else{
    $data['year']=$year;
  }
  if (empty($price)) { $errors["price"] ="Price is required"; }else{
    $data['price']=$price;
  }  
  if (empty($quantity)) { $errors["quantity"] ="Quantity is required"; }else{
    $data['quantity']=$quantity;
  }  
  $data['discount']=$discount;

  // File upload path
  $targetDir = "../admin/uploads/";
  $fileName = rand(0,99999999).basename($_FILES["upload_image"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

  if(!empty($_FILES["upload_image"]["name"])){
      // Allow file formats
      $allowTypes = array('jpg','png','jpeg');
      
      if(in_array($fileType, $allowTypes)){        
          move_uploaded_file($_FILES["upload_image"]["tmp_name"], $targetFilePath);
      }else{
        $errors["imageFormate"] = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.';
      }
  }else{
      $errors["imageFormate"] = 'Image is empty';
  }

  if (count($errors) == 0) {
  	$query = "INSERT INTO books (`id`, `book_name`, `author_name`, `category`, `year`, `discount`, `price`, `quantity`,`images`) 
  			  VALUES(NULL,'$bookname','$authorName','$category', '$year','$discount','$price','$quantity','$fileName')";
  	if(mysqli_query($conn, $query)){
      header("Location: http://localhost/bookstore/admin/index.php?pagename=add-book&&success=true");      
    }else{
      $errors["Sql"] = 'Server error! try again';  
      $errors = urlencode(serialize($errors));
      $data = urlencode(serialize($data));
      header("Location: http://localhost/bookstore/admin/index.php?pagename=add-book&&error=$errors&&data=$data");
    }
  }else{
    $errors = urlencode(serialize($errors));
    $data = urlencode(serialize($data));
    
    print_r($_POST);
    header("Location: http://localhost/bookstore/admin/index.php?pagename=add-book&&error=$errors&&data=$data");

  }
}