<?php
    $actual_link = $_SERVER["REQUEST_URI"];
    $pageName = explode("pagename=",explode("&",$actual_link)[0]);
    $pageNameCount = count(explode("pagename",$actual_link));
    $book = str_contains($actual_link,"-book")||str_contains($actual_link,"book-");
    $user = str_contains($actual_link,"-user")||str_contains($actual_link,"user-");
    if($pageNameCount!=1){
        $pageName= $pageName[1];
    }
?>

<!-- Sidebar -->
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

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>Book Management</span>
        </a>
        <div id="collapseOne" class="collapse <?php echo ($book==1)?"show":""; ?>" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Management</h6>
                <a class="collapse-item <?php echo ($pageName=="add-book")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=add-book">Add Book</a>
                <a class="collapse-item <?php echo ($pageName=="edit-book")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=edit-book">Edit Book</a>
                <a class="collapse-item <?php echo ($pageName=="delete-book")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=delete-book">Delete book</a>
                <a class="collapse-item <?php echo ($pageName=="book-list")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=book-list">Book list</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>User Management</span>
        </a>
        <div id="collapseTwo" class="collapse <?php echo ($user==1)?"show":""; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Management</h6>
                <a class="collapse-item <?php echo ($pageName=="edit-user")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=edit-user">Edit User</a>
                <a class="collapse-item <?php echo ($pageName=="delete-user")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=delete-user">Delete User</a>
                <a class="collapse-item <?php echo ($pageName=="user-list")?"active":""; ?>" href="/bookstore/admin/index.php?pagename=user-list">All Users</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Borrow & request
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    
    <li class="nav-item <?php echo ($pageName=="borrow-list")?"active":""; ?>">
        <a class="nav-link" href="/bookstore/admin/index.php?pagename=borrow-list">
            <i class="fa fa-window-restore" aria-hidden="true"></i>
            <span>Borrow list</span>
        </a>
    </li>
    
    <li class="nav-item <?php echo ($pageName=="request-list")?"active":""; ?>">
        <a class="nav-link" href="/bookstore/admin/index.php?pagename=request-list">
            <i class="fa fa-window-restore" aria-hidden="true"></i>
            <span>Request book list</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>