<?php     
    require './layout/header.php';
    require './layout/startSection.php';
    require './layout/navbar.php';
    require './backend/dbconnect.php';
    
    $conn = OpenCon();
    
    $sql = 'SELECT * FROM `books` ORDER BY id DESC limit 12';
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
 ?>

    <section id="products" class="products pb-5">
        <div class="container d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col sm-12">
                    <div class="headline text-center md-5">
                        <h2 class="pb-3 position-relative d-inline-block">
                            FEATURED BOOKS
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                if($count>0){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a class="d-block text-center mb-4">
                        <div class="product-list">
                            <div class="product-image position-relative">
                                <img src="./admin/uploads/<?php echo $row['images']; ?>" alt="book" srcset=""
                                    class="img-fluid product-image-first" style="height:300px;">
                                   <?php if($row['discount']!=0){ ?> <span class="position-absolute px-3 py-2 fw-bolder rounded-3 discountShow"><?php echo $row['discount']; ?> % <span style='font-size:10px'>Discount</span></span></span><?php } ?>
                            </div>
                            <div class="product-name pt-3">
                                <h3 class="text-capitalize" style="height:40px; overflow:hidden"><?php echo $row['book_name']; ?></h3>
                                <p class="mb-0 author"><?php echo $row['author_name']; ?></p>
                                <p class="mb-0 amount">৳ <?php echo ($row['discount']!=0)?$row['price']-($row['price']*$row['discount'])/100 ."<del> ৳".$row['price']."</del>":$row['price']; ?></p>
                                <p class="mb-0 quantity"><strong>Quantity: </strong> <span class="quantity_item"><?php echo $row['quantity']; ?></span></p>
                                <p class="d-block mt-3 text-dark bg-info mx-4 rounded-3 d-none borrow_book">Borrow request success</p>
                                <?php
                                if($row['quantity']>0){?>
                                <button type="button" data-name="<?php echo str_replace(' ', '_', $row['book_name']); ?>" data-price="<?php echo ($row['discount']!=0)?$row['price']-($row['price']*$row['discount'])/100:$row['price']; ?>" data-quantity="<?php echo $row['quantity']; ?>" data-id="<?php echo $row['id']; ?>" class="cart btn btn-success mb-3 mt-3">Add to cart</button>
                                <button type="button" class="btn btn-primary mb-3 mt-3 borrowBook">Borrow book</button>
                                <?php }else{ ?>
                                    <input type="hidden" class="bookId" value="<?php echo $row['id'] ?>" />
                                     <button type="button" class="btn btn-warning mb-3 mt-3 requestBook">Request book</button>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>            
            <a href="/bookstore/pages/books.php" class="btn btn-info mt-5 mx-auto">All Books</a>
            <?php }else { ?>
                <div class="alert alert-danger mt-5" role="alert">
                    No books found
                </div>
            <?php } ?>
        </div>
        
        <div class="offers" id="sale">
            <div class="container">
                <div class="row">
                    <!-- Offer box 1 -->
                    <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4">
                        <a href="./pages/books.php?discount=30">
                            <div class="offer-box text-center position-relative">
                                <div class="offer-inner">
                                    <div class="offer-image position-relative overflow-hidden">
                                        <img src="assets/img/offers/khirer_putul.jpg" alt="khirer_putul"
                                            class="img-fluid">
                                        <div class="offer-overlay"></div>
                                    </div>
                                    <div class="offer-info">
                                        <div class="offer-info-inner">
                                            <p class="heading-bigger text-capitalize">
                                                Sale 30%
                                            </p>
                                            <p class="offer-title-1 text-uppercase font-weight-bold">
                                                Don't miss this chance
                                            </p>
                                            <button class="btn btn-outline-danger text-uppercase mt-4">Buy
                                                now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Offer box 2 -->
                    <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4 d-flex flex-column justify-content-between">
                        <a href="./pages/books.php?discount=70">
                            <div class="offer-box text-center position-relative mb-4 mb-sm-0 mb-lg-0">
                                <div class="offer-inner">
                                    <div class="offer-image position-relative overflow-hidden">
                                        <img src="assets/img/offers/dark_matter_energy.jpg" alt="khirer_putul"
                                            class="img-fluid">
                                        <div class="offer-overlay"></div>
                                    </div>
                                    <div class="offer-info">
                                        <div class="offer-info-inner">
                                            <p class="heading-bigger text-capitalize">
                                                Sale 70%
                                            </p>
                                            <p class="offer-title-1 text-uppercase font-weight-bold">
                                                Don't miss this chance
                                            </p>
                                            <button class="btn btn-outline-danger text-uppercase mt-4">Buy
                                                now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="./pages/books.php?discount=50">
                            <div class="offer-box text-center position-relative">
                                <div class="offer-inner">
                                    <div class="offer-image position-relative overflow-hidden">
                                        <img src="assets/img/offers/choddobesh.png" alt="choddobesh" class="img-fluid">
                                        <div class="offer-overlay"></div>
                                    </div>
                                    <div class="offer-info">
                                        <div class="offer-info-inner">
                                            <p class="heading-bigger text-capitalize">
                                                Sale 50%
                                            </p>
                                            <p class="offer-title-1 text-uppercase font-weight-bold">
                                                Don't miss this chance
                                            </p>
                                            <button class="btn btn-outline-danger text-uppercase mt-4">Buy
                                                now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Offer box 3 -->
                    <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4">
                        <a href="./pages/books.php?discount=20">
                            <div class="offer-box text-center position-relative">
                                <div class="offer-inner">
                                    <div class="offer-image position-relative overflow-hidden">
                                        <img src="assets/img/offers/mohanobi.jpg" alt="mohanobi" class="img-fluid">
                                        <div class="offer-overlay"></div>
                                    </div>
                                    <div class="offer-info">
                                        <div class="offer-info-inner">
                                            <p class="heading-bigger text-capitalize">
                                                Sale 20%
                                            </p>
                                            <p class="offer-title-1 text-uppercase font-weight-bold">
                                                Don't miss this chance
                                            </p>
                                            <button class="btn btn-outline-danger text-uppercase mt-4">Buy
                                                now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Button trigger modal -->

<?php     
    require './layout/endSection.php';
    require './layout/footer.php';
 ?>
    