<?php
    include '../backend/function.php';        
    $borrowSql = select("borrow_book");
    $borrowCount = $borrowSql->num_rows;    
    $requestSql = select("request_book");
    $requestCount = $requestSql->num_rows;    
    $orderList = joinData("SELECT * FROM orders JOIN shipping ON shipping.order_id = orders.order_id JOIN payment ON payment.order_id = orders.order_id ORDER BY orders.id DESC");
    $totalAmmount = sumData("SELECT SUM(amount) as amount FROM `payment`");
    $totalAmmount =$totalAmmount->fetch_assoc();
?>
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Sale </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> BDT <?php echo $totalAmmount['amount']; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $orderList->num_rows; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        
        <!-- Earnings (Annualy) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 me-4">
                <a href="/bookstore/admin/index.php?pagename=borrow-list">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Borrow List
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $borrowCount; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6">            
            <div class="card border-left-info shadow py-2">
                <a href="/bookstore/admin/index.php?pagename=request-list">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Request List
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $requestCount; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order List</h6>                    
                </div>                
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                        role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <tbody>
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 30px;">
                                                        Sl</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 80px;">
                                                        Order id</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 176px;">
                                                        Book name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                                        style="width: 176px;">Quantity</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                                        style="width: 176px;">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-label="Office: activate to sort column ascending"
                                                        style="width: 126px;">Address</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-label="Salary: activate to sort column ascending"
                                                        style="width: 107px;">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-label="Salary: activate to sort column ascending"
                                                        style="width: 107px;">Payment Status</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                        <?php 
                                            if($orderList->num_rows>0){
                                                $i=1;
                                                while($row = $orderList->fetch_assoc()){ ?>
                                                    <tr class="odd">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['book_name']; ?></td>
                                                        <td><?php echo $row['quantity']; ?></td>
                                                        <td><?php echo $row['f_name']." ".$row['f_name']; ?></td>
                                                        <td><?php echo $row['address']; ?></td>
                                                        <td><?php echo $row['user_email']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>                                                        
                                                    </tr>
                                                    <?php $i++;?>
                                        <?php   }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>