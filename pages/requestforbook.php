<?php 
session_start();
if(!isset($_SESSION['email'])){
  header("location: /bookstore/pages/login.php");
}
    include '../layout/header.php';
    include '../layout/startSection.php';
    include '../layout/navbar.php';
    
    if(isset($_GET['err']) || isset($_GET['data'])){
     $errors = unserialize(urldecode($_GET['err']));
     $data = unserialize(urldecode($_GET['data']));
    }else{
      if(isset($_GET['success'])){
        $success =1;
      }
    }
    if(isset($_GET['bookname'])){
      $data['book_name'] = $_GET['bookname'];
      $data['author_name'] = $_GET['authorName'];
      $data['book_id'] = $_GET['bookId'];
    }
    
 ?>

<section style="margin-top:100px ;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5 py-4">
        <img src="../../bookstore/assets/img/book_libary.jpeg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="../../bookstore/backend/requestBook.php">
        <h2 class="my-5">Request For book</h2>
          <!-- Request input -->
          <div class="form-outline mb-4">
          <span class="bg-danger text-white errorMsg rounded-2"><?php if(isset($errors['book_name'])){echo $errors['book_name'];} ?></span>
          <label class="form-label" for="form3Example3">Request Book Name</label>            
            <input type="text" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter book name" value="<?php if(isset($data['book_name'])){echo $data['book_name'];} ?>" name="book_name"  required/>
          </div>

          <!-- Author input -->
          <div class="form-outline mb-3">
          <span class="bg-danger text-white errorMsg rounded-2"><?php if(isset($errors['author_name'])){echo $errors['author_name'];} ?></span>
          <label class="form-label" for="form3Example4">Author Name</label>          
            <input type="text" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter author name"  value="<?php if(isset($data['author_name'])){echo $data['author_name'];} ?>" name="author_name"/>
            <input type="hidden" name="book_id" value="<?php if(isset($data['book_id'])){echo $data['book_id'];}else{echo "no id";} ?>" />
          </div>
          <p class="text-success <?php if(isset($success)){echo $success;}else{echo 'd-none';}?>">Request send successfully</p>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" name="RequestBook"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Send request</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
 
 
<?php 
    
    include '../layout/endSection.php';
    include '../layout/footer.php';


 ?>