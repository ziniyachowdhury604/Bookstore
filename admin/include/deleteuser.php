<?php
    if(isset($_GET['user_data'])){
        $data  = unserialize(urldecode($_GET['user_data']));
    }
    if(isset($_GET['err'])){
        $errors = unserialize(urldecode($_GET['err']));
    }
    if(isset($_GET['success'])){
        $success = "User delete successfully";
    }

?>

<div class="container">
    <form method="get" action="../backend/delete-user.php">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_id">User id</label>
                    <input  type="text" class="form-control" placeholder="" name="user_id" id="user_id" value="<?php if(isset($data['id'])){echo $data['id'];}?>" pattern="^[0-9]{1,}$" title="ID must be number" required>
                    <span class="d-inline-block mt-2 float-right" style="cursor: pointer;" id="ste">switch to email</span>
                </div>
            </div>
            <div class="col-md-6 d-none">
                <div class="form-group">
                    <label for="user_id">Delete email</label>
                    <input  type="email" class="form-control" placeholder="" id="user_email" value="<?php if(isset($data['email'])){echo $data['email'];}?>" pattern="[A-z0-9._+%-]+@[A-z0-9]+\.[A-z]{2,4}$" title="Invalid email format">
                    <span class="d-inline-block mt-2 float-right" style="cursor: pointer;" id="sti">switch to id</span>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="form-group pt-sm-4 pt-0">
                    <input type="submit" class="btn btn-info mt-sm-2 mt-0 w-100" name="find" value="Find"/>    
                </div>                   
            </div>
        </div>
    </form> 
    <form class="mt-5" enctype="multipart/form-data"  action="../../bookstore/backend/delete-user.php" name="registrationUpdateForm" method="POST"> 
        <?php if(isset($success)){?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>                        
        <?php } ?>
        <h2>Delete User</h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="nameReg">Your Name</label>
                    <input disabled type="text" class="form-control" value="<?php if(isset($data['name'])){echo $data['name'];} ?>" name="name" onkeyup="allLetter(document.registrationForm.name);" pattern="[A-z]{0,}\s?[A-Za-z]{0,}" title="Only Character Allow" required/>
                    <input type="hidden" name="user_id" value="<?php if(isset($data['id'])){echo $data['id'];}?>" />
                    <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['name'])){echo $errors['name'];} ?></span>
                </div>
            </div>

            <div class="col-md-6">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input disabled type="email" id="form3Example3c" class="form-control" value="<?php if(isset($data['email'])){echo $data['email'];} ?>" name="email" pattern="[A-z0-9._+%-]+@[A-z0-9]+\.[A-z]{2,4}$" title="Invalid email format" required/>
                        <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['email'])){echo $errors['email'];} ?></span>
                    </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-6">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example4c">Password</label>
                    <input disabled type="password" id="form3Example4c" class="form-control" value="<?php if(isset($data['password'])){echo $data['password'];} ?>" name="password" minlength="8" title="Minimun length 8" required/>
                    <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['password'])){echo $errors['password'];} ?></span>
                    <input disabled type="hidden" value="<?php if(isset($data['password'])){echo $data['password'];} ?>" name="oldpassword">
                </div>
            </div>
                
            <div class="col-md-6">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example4ce">Mobile</label>
                    <input disabled type="tel" id="form3Example4ce" class="form-control" value="<?php if(isset($data['mobile'])){echo $data['mobile'];} ?>" name="mobile" pattern="[0]{1}[1]{1}[0-9]{9}" title="Must start with 01 pattern & length is 11" required/>
                    <span class="text-danger errorMsg rounded-2"><?php if(isset($errors['mobile'])){echo $errors['mobile'];} ?></span>
                </div>
            </div>
        </div>
        <div class="row pt-3">
        <div class="col-md-6">
            <input type="submit" class="btn btn-primary" name="delete_user" value="Delete"/>           
        </div>     
        </div>
    </form>
</div>