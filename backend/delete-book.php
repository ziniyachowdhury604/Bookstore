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
            header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-book&book_data=$data");
        }else{
            header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-book&error=Book id not found");
        }
    }
    else if(isset($_POST['delete_book'])){
        
        include '../backend/dbconnect.php';
        $conn = OpenCon(); 
        $bookid = mysqli_real_escape_string($conn, $_POST['book_id']);
        $old_images = mysqli_real_escape_string($conn, $_POST['old_image']);
        $targetDir = "../admin/uploads/";
        if (file_exists($targetDir.$old_images)) {
            unlink($targetDir.$old_images);
        }
        $query = "DELETE FROM books WHERE `books`.`id` = $bookid";
        
        if(mysqli_query($conn, $query)){                
            header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-book&&success=true");      
        }else{
            echo "Server error";
        }
    }
    else{
        header("Location: http://localhost/bookstore/admin/index.php?pagename=delete-book");
    }

?>