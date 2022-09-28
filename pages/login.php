<?php 

    include '../layout/header.php';
    include '../layout/startSection.php';
    include '../layout/navbar.php';
    
    if(isset($_GET['error'])){
      $error = $_GET['error'];
    }
    
 ?>

<section style="margin-top:100px ; min-height:75vh">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../../bookstore/assets/img/login-side.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="../../bookstore/backend/login.php">
        <h2 class="my-5">Login</h2>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="email" pattern="[A-z0-9._+%-]+@[A-z0-9]+\.[A-z]{2,4}$" title="Invalid email format" required/>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-1">
            <label class="form-label" for="form3Example4">Password</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" name="password"  minlength="8" title="Minimun length 8" required/>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-2">
            <a href="" class="text-body">Forgot password?</a>
          </div>
          <?php
          if(isset($error)){ ?>
            <div class="form-outline mb-1">
              <div class="alert alert-danger" role="alert">              
                    <?php echo $error; ?>                
              </div>
            </div>
           <?php } ?>
          <div class="text-center text-lg-start mt-2 pt-2">
            <input type="hidden" value="<?php echo isset($_GET['cart']); ?>" name="cart">
            <button type="submit" class="btn btn-primary btn-lg" name="loginBtn"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="../pages/registration.php"
                class="link-danger">Register</a></p>
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
    