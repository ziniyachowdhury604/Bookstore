<?php

include '../backend/dbconnect.php';
$conn = OpenCon();
 
if((isset($_GET['user_id'])||isset($_GET['user_email']))&&isset($_GET['find'])){ 

  $id = isset($_GET['user_id'])?$_GET['user_id']:(isset($_GET['user_email'])?$_GET['user_email']:"");
  $col = isset($_GET['user_id'])?'id':(isset($_GET['user_email'])?'email':"");
  $sql = "select * from users where `$col` = '$id'";
  
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);
  print_r($data);
  if($data){
      $data = urlencode(serialize($data));            
      header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-user&user_data=$data");
  }else{
      header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-user&error=User id not found");
  }
  
  
}else if(isset($_POST['update_user'])){
  
  // initializing variables
  $name = "";
  $email    = "";
  $password    = "";
  $mobile    = "";
  $errors = array(); 
  $data = array(); 


  // update USER
  if (isset($_POST['update_user'])) {
    // receive all input values from the form
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $oldPassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    

    if (empty($name)) {$errors["name"] = "Username is required"; }else{
      $data['name']=$name;
    }
    if (empty($email)) { $errors["email"] ="Email is required"; }else{
      $data['email']=$email;
    }
    if($oldPassword != $password){
      if (empty($password)) { $errors["password"] ="Password is required"; }else{
          if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
            $errors["password"] = "Password must be at least 8 characters <br> Must contain at least one number<br> One upper case letter <br> One lower case letter <br>and one special character.";
          }          
          $data['password']=$password;
      }
    }else{
      $data['password']=$password;
      $password = $oldPassword;
    }
    if (empty($mobile)) { $errors["mobile"] ="Mobile is required"; }else{
      $data['mobile']=$mobile;
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

      $query = "UPDATE `users` SET `email` = '$email', `password` = '$password', `name` = '$name', `mobile` = '$mobile' WHERE `users`.`id` = $userid";
      
      mysqli_query($conn, $query);
      header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-user&&success=true");
      
    }else{
      print_r($errors);
      $errors = urlencode(serialize($errors));
      $data = urlencode(serialize($data));
      header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-user&err=$errors&user_data=$data");
    }
  }
}