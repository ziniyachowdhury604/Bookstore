<?php
    if(isset($_GET['book_data'])){
        $data  = unserialize(urldecode($_GET['book_data']));
    }
    else if(isset($_GET['error'])){
        $error = $_GET['error'];
    }
    else if(isset($_GET['success'])){
        $success = "Data update successfully";
    }

?>

<div class="container">
    <form method="get" action="../backend/edit-book.php">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="book_id">Book id</label>
                    <input type="text" class="form-control" placeholder="" name="book_id" id="book_id" value="<?php if(isset($data['id'])){echo $data['id'];}?>" pattern="^[0-9]{1,}$" title="ID must be number" required>
                    <span class="text-danger"><?php if(isset($error)){echo $error;} ?></span>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="form-group pt-sm-4 pt-0">
                    <input type="submit" class="btn btn-info mt-sm-2 mt-0 w-100" name="find" value="Find"/>    
                </div>                   
            </div>
        </div>
    </form> 
    <form method="POST" action="../backend/edit-book.php" enctype="multipart/form-data" class="mt-5">
        <?php if(isset($success)){?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>                        
        <?php } ?>
        <h2>Edit book</h2>        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first">Book Name</label>
                    <input type="hidden" name="book_id" value="<?php if(isset($data['id'])){echo $data['id'];}?>" />
                    <input type="text" class="form-control" placeholder="" value="<?php if(isset($data['book_name'])){echo $data['book_name'];}?>" name="book_name" id="first" pattern="^(?!^ +$)([\w -&]+)$" title="Special letters are not allowed" required>
                </div>
            </div>
            <!--  col-md-6   -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last">Author Name</label>
                    <input type="text" class="form-control" placeholder="" value="<?php if(isset($data['author_name'])){echo $data['author_name'];}?>" name="author_name" id="last" pattern="^[a-zA-Z\s]*$" title="Only letters allow" required>
                </div>
            </div>
            <!--  col-md-6   -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Category</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="category" required>
                    <option value="none" <?php if(isset($data['category']) && $data['category']=='none'){echo 'selected';} ?>>none</option>
                    <option value="Comic" <?php if(isset($data['category']) && $data['category']=='Comic'){echo 'selected';} ?>>Comic book</option>
                    <option value="Fantasy" <?php if(isset($data['category']) && $data['category']=='Fantasy'){echo 'selected';} ?>>Fantasy</option>
                    <option value="Classics" <?php if(isset($data['category']) && $data['category']=='Classics'){echo 'selected';} ?>>Classics</option>
                    <option value="Historical" <?php if(isset($data['category']) && $data['category']=='Historical'){echo 'selected';} ?>>Historical Fiction</option>
                    <option value="Horror" <?php if(isset($data['category']) && $data['category']=='Horror'){echo 'selected';} ?>>Horror</option>
                    <option value="Love" <?php if(isset($data['category']) && $data['category']=='Love'){echo 'selected';} ?>>Love Story</option>
                    <option value="Science" <?php if(isset($data['category']) && $data['category']=='Science'){echo 'selected';} ?>>Science Fiction (Sci-Fi)</option>
                    </select>
                </div>
            </div>
            <!--  col-md-4   -->

            <div class="col-md-4">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" id="year" name="year"value="<?php if(isset($data['year'])){echo $data['year'];}?>" pattern="^[0-9]{4}$" title="Year must be 4 digits number " required>
                </div>
            </div>
            <!--  col-md-4   -->

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Discounts</label>
                    <select class="form-control" id="exampleFormControlSelect2" name="discount" required>
                        <option value="0"  <?php if(isset($data['discount']) && $data['discount']=='0'){echo 'selected';} ?>>No discount</option>
                        <option value="10" <?php if(isset($data['discount']) && $data['discount']=='10'){echo 'selected';} ?>>10% Discounts</option>
                        <option value="20" <?php if(isset($data['discount']) && $data['discount']=='20'){echo 'selected';} ?>>20% Discounts</option>
                        <option value="30" <?php if(isset($data['discount']) && $data['discount']=='30'){echo 'selected';} ?>>30% Discounts</option>
                        <option value="40" <?php if(isset($data['discount']) && $data['discount']=='40'){echo 'selected';} ?>>40% Discounts</option>
                        <option value="50" <?php if(isset($data['discount']) && $data['discount']=='50'){echo 'selected';} ?>>50% Discounts</option>
                        <option value="60" <?php if(isset($data['discount']) && $data['discount']=='60'){echo 'selected';} ?>>60% Discounts</option>
                        <option value="70" <?php if(isset($data['discount']) && $data['discount']=='70'){echo 'selected';} ?>>70% Discounts</option>
                        <option value="80" <?php if(isset($data['discount']) && $data['discount']=='80'){echo 'selected';} ?>>80% Discounts</option>
                        <option value="90" <?php if(isset($data['discount']) && $data['discount']=='90'){echo 'selected';} ?>>90% Discounts</option>
                    </select>
                </div>
            </div>
            <!--  col-md-4   -->
            
            
        </div>
        <!--  row   -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php if(isset($data['price'])){echo $data['price'];}?>" pattern="^[0-9]{1,}$" title="price must be number " required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php if(isset($data['quantity'])){echo $data['quantity'];}?>" pattern="^[0-9]{1,}$" title="quantity must be number " required>
                </div>
            </div>
        </div>

        <!--  row   -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <img class="img-fluid rounded-3 <?php if(!isset($data['images'])){echo 'd-none';}?>" width="250" height="250" src="../admin/uploads/<?php if(isset($data['images'])){echo $data['images'];}?>" alt="<?php if(isset($data['images'])){echo $data['images'];}?>"/>
                    <input type="hidden" value="<?php if(isset($data['images'])){echo $data['images'];}?>"  name="old_image" />
                </div>
            </div>
        </div>
        <!--  row   -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bookImage">Change</label>
                    <input type="file" class="form-control-file d-none" name="upload_image" value="<?php if(isset($data['images'])){echo $data['images'];}?>" id="bookImage">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="update_book" value="Update"/>
    </form>
</div>