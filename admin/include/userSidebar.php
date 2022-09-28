<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/bookstore/index.php">
        <div class="sidebar-brand-icon rotate-n-15" style="height: 30px; width:30px">
            <img src="../assets/img/book_icon.png" alt="" style="height: 100%; width:100%" />
        </div>
        <div class="sidebar-brand-text mx-3">Bookstore</div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($pageNameCount==1)?"active":""; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="/bookstore/pages/books.php">
            <i class="fa fa-book"></i>
            <span>Buy book</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="/bookstore/pages/books.php">
            <i class="fa fa-book"></i>
            <span>Borrow book</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/bookstore/pages/requestforbook.php">
            <i class="fa fa-book"></i>
            <span>Request book</span>
        </a>
    </li>
    

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>