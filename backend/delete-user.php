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
      header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-user&user_data=$data");
  }else{
      header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-user&error=User id not found");
  }
  
  
}else if(isset($_POST['delete_user'])){
    // receive all input values from the form
    print_r($_POST);
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    $query = "DELETE FROM users WHERE `users`.`id` = $userid";
        
    if(mysqli_query($conn, $query)){                
        header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-user&&success=true");      
    }else{
        echo "Server error";
    }
}