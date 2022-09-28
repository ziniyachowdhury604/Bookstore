<?php if (session_status() === PHP_SESSION_NONE) {session_start();}?>
    <!-- Navition section -->
    <header id="header">
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/bookstore/index.php">
                    <img src="../../bookstore/assets/img/book_icon.png" alt="book_icon">
                    <span class="mx-3">Book store</span>
                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    
                    <span class="ti-align-justify navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/../bookstore/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/bookstore/pages/books.php">Book List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/../bookstore/pages/requestforbook.php">Request For Book</a></li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/bookstore/index.php#contact">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#nodata" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <span class="ti-user"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                if(!isset($_SESSION["success"])){?>
                                    <li><a class="dropdown-item" href="/../bookstore/pages/login.php">Login</a></li>
                                    <li><a class="dropdown-item" href="/../bookstore/pages/registration.php">Registration</a></li> 
                                <?php }else{ ?>
                                    <li><a class="dropdown-item" href="/bookstore/admin/index.php">Dashboard</a></li>      
                                    <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item bg-primary">
                            <a class="nav-link" href="#nodata">
                            <span class="ti-shopping-cart"></span>
                            <button type="button" class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Cart (<span class="total-count"></span>)</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
      </div>
      <div class="modal-body">
        <table class="show-cart table">
          
        </table>
        <div>Total price: ৳ <span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary orderNowBtn">Order now</button>
      </div>
    </div>
  </div>
</div>
