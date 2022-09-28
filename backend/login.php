<?php      
    session_start();
    /* Include dbconnect */
    include '../backend/dbconnect.php';
    
    //Start connection
    $conn = OpenCon(); 
    
    $email = $_POST['email'];  
    $password = $_POST['password']; 
    $cart = $_POST['cart']; 
      
    //to prevent from mysqli injection 
        
    $email = stripcslashes($email);  
    $password = stripcslashes($password);  
    $email = mysqli_real_escape_string($conn, $email);  
    $password = md5(mysqli_real_escape_string($conn, $password));  
    
    $sql = "select * from users where email = '$email' and password = '$password'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
        
    if($count == 1){     
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['success'] = "You are now logged in";
        if($cart==1){
            header("Location: /bookstore/pages/order.php");            
        }else{
            header("Location: ../admin/index.php");            
        }
    }  
    else{  
        header("Location: ../../bookstore/pages/login.php?error=Username or password didn't match");     
    }    
        
    CloseCon($conn); 
?>  