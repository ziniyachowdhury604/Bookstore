<?php

include '../backend/dbconnect.php';
$conn = OpenCon(); 

// initializing variables
$name = "";
$email    = "";
$password    = "";
$confirmPassword    = "";
$mobile    = "";
$errors = array(); 
$data = array(); 


// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  

  if (empty($name)) {$errors["name"] = "Username is required"; }else{
    $data['name']=$name;
  }
  if (empty($email)) { $errors["email"] ="Email is required"; }else{
    $data['email']=$email;
  }
  if (empty($password)) { $errors["password"] ="Password is required"; }else{
    
    if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
      $errors["password"] = "Password must be at least 8 characters <br> Must contain at least one number<br> One upper case letter <br> One lower case letter <br>and one special character.";
    }
        
    $data['password']=$password;
  }
  if (empty($confirmPassword)) { $errors["confirmPassword"] ="ConfirmPassword is required"; }else{
    $data['confirmPassword']=$confirmPassword;
  }
  if (empty($mobile)) { $errors["mobile"] ="Mobile is required"; }else{
    $data['mobile']=$mobile;
  }
  
  
  if ($password != $confirmPassword) {
	  $errors["passwordmatch"] = "Password & confirm password don't match";
  }else{
    $data['password']=$password;
    $data['confirmPassword']=$confirmPassword;
    
  }

  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    
    if ($user['email'] === $email) {
      $errors["email"] ="Email already exists";
    }else{
    $data['email']=$email;
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password); //encrypt the password before saving in the database

  	$query = "INSERT INTO users (name,email, password,mobile,status,role) 
  			  VALUES('$name','$email','$password', '$mobile','1','user')";
  	mysqli_query($conn, $query);
    header("Location: http://localhost/bookstore/pages/registration.php?success=true");
  }else{
    $errors = urlencode(serialize($errors));
    $data = urlencode(serialize($data));
    header("Location: http://localhost/bookstore/pages/registration.php?err=$errors&&data=$data");
  }
}