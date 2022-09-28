<?php

    if(isset($_GET['book_id'])&&isset($_GET['find'])){
        include '../backend/dbconnect.php';
        $conn = OpenCon(); 
    
        $id = $_GET['book_id'];
        
        $sql = "select * from books where id = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        if($data){
            $data = urlencode(serialize($data));            
            header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-book&book_data=$data");
        }else{
            header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-book&error=Book id not found");
        }
    }
    else if(isset($_POST['update_book'])){
        
        $errors = array(); 
        include '../backend/dbconnect.php';
        $conn = OpenCon(); 
        $bookid = mysqli_real_escape_string($conn, $_POST['book_id']);
        $bookname = mysqli_real_escape_string($conn, $_POST['book_name']);
        $authorName = mysqli_real_escape_string($conn, $_POST['author_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $discount = mysqli_real_escape_string($conn, $_POST['discount']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $old_images = mysqli_real_escape_string($conn, $_POST['old_image']);
        
        
        $targetDir = "../admin/uploads/";
        $fileName = basename($_FILES["upload_image"]["name"]);
        if($fileName!=""){
            $fileName = rand(0,99999999).basename($_FILES["upload_image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg');
      
            if(in_array($fileType, $allowTypes)){               
                if (file_exists($targetDir.$old_images)) {
                    unlink($targetDir.$old_images);
                }  
                move_uploaded_file($_FILES["upload_image"]["tmp_name"], $targetFilePath);
            }else{
                $errors["imageFormate"] = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.';
            }
            $old_images = $fileName;
        }
        if (count($errors) == 0) {
            $query = "UPDATE `books` SET `book_name` = '$bookname', `author_name` = '$authorName', `category` = '$category', `year` = '$year', `discount` = '$discount', `price` = '$price', `quantity` = '$quantity', `images` = '$old_images' WHERE `books`.`id` = $bookid";
            if(mysqli_query($conn, $query)){
                header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-book&&success=true");      
            }else{
                echo "Server error";
            }
        }
    }
    else{
        header("Location: http://localhost/bookstore/admin/index.php?pagename=edit-book");
    }

?>