<?php 
     include '../layout/header.php';
     include '../layout/startSection.php';
     include '../layout/navbar.php';
    
 ?>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" action="../../bookstore/backend/registration.php" name="registrationForm" method="POST">
                    <?php
                        if(isset($_GET['err']) || isset($_GET['data'])){
                         $errors = unserialize(urldecode($_GET['err']));
                         $data = unserialize(urldecode($_GET['data']));
                        }else{
                          if(isset($_GET['success'])){
                            echo "<script>alert('Signup successfull')</script>";
                          }
                        }
                     ?>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['name'])){echo $errors['name'];} ?></span>
                      <input type="text" class="form-control" value="<?php if(isset($data['name'])){echo $data['name'];} ?>" name="name" onkeyup="allLetter(document.registrationForm.name);" pattern="[A-z]{0,}\s?[A-Za-z]{0,}" title="Only Character Allow" required/>
                      <label class="form-label" for="nameReg">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['email'])){echo $errors['email'];} ?></span>
                      <input type="email" id="form3Example3c" class="form-control" value="<?php if(isset($data['email'])){echo $data['email'];} ?>" name="email" pattern="[A-z0-9._+%-]+@[A-z0-9]+\.[A-z]{2,4}$" title="Invalid email format" required/>
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['password'])){echo $errors['password'];} ?></span>
                      <input type="password" id="form3Example4c" class="form-control" value="<?php if(isset($data['password'])){echo $data['password'];} ?>" name="password" minlength="8" title="Minimun length 8" required/>
                      <label class="form-label" for="form3Example4c">Password</label>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['confirmPassword'])){echo $errors['confirmPassword'];} ?></span>
                      <br><span class="text-danger errorMsg rounded-2"><?php if(isset($errors['passwordmatch'])){echo $errors['passwordmatch'];} ?></span>
                      <input type="password" id="form3Example4cd" class="form-control" value="<?php if(isset($data['confirmPassword'])){echo $data['confirmPassword'];} ?>" name="confirm_password"  minlength="8" title="Minimun length 8" required/>
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['mobile'])){echo $errors['mobile'];} ?></span>
                      <input type="tel" id="form3Example4ce" class="form-control" value="<?php if(isset($data['mobile'])){echo $data['mobile'];} ?>" name="mobile" pattern="[0]{1}[1]{1}[0-9]{9}" title="Must start with 01 pattern & length is 11" required/>
                      <label class="form-label" for="form3Example4ce">Mobile</label>
                    </div>
                  </div>

                  
                  <div class="d-flex flex-column justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="register">Register</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="../pages/login.php"
                      class="link-danger">Login</a></p>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="../../bookstore/assets/img/registration.webp"
                  class="img-fluid" alt="Sample image" />

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php 
    
    include '../layout/endSection.php';
    include '../layout/footer.php';


 ?>