<?php
    include '../backend/function.php';
    $result= select("orders"," where `user_email` ='".$_SESSION['email']."' ORDER BY date DESC");
    $totalBook=0;
    $totalAmount=0;
    $orders=array();
    $requests=array();
    $borrows=array();
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $totalBook+=   (int)$row['quantity'];
        $totalAmount+=   ((int)$row['price']*(int)$row['quantity']);
        array_push($orders,$row);
    }
    
    $BorrowResult= select("borrow_book"," where `email` ='".$_SESSION['email']."'");
    
    while($row = mysqli_fetch_array($BorrowResult, MYSQLI_ASSOC)){
        array_push($borrows,$row);
    }
    $RequestResult= select("request_book"," where `email` ='".$_SESSION['email']."'");    
    while($row = mysqli_fetch_array($RequestResult, MYSQLI_ASSOC)){
        array_push($requests,$row);
    }
    
?>
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs mb-2 font-weight-bold text-primary text-uppercase mb-1">
                                Total Book Buy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 d-flex">
                                <h4 class="pr-2 pl-2 mr-2" style="border-right: 2px solid #ccc;"> <?php echo $totalBook; ?></h4>
                                <h4 class="pl-2"><?php echo $totalAmount." BDT"; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Book Borrow</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $BorrowResult->num_rows; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Book Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $RequestResult->num_rows; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">
        
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                </div>
                <div class="card-body">
                     
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Order id</th>
                        <th scope="col">Book name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $i=1;
                    foreach($orders as $order){ ?>
                      <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['book_name']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                    </tr>   
                    <?php  $i++; }?>
                                  
                </tbody>
            </table>                
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">        
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Borrow book list</h6>
                </div>
                <div class="card-body">                     
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book name</th>
                            <th scope="col">Assign Date</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=1;
                        foreach($borrows as $borrow){ ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $borrow['book_name']; ?></td>
                            <td><?php echo $borrow['assign_date']; ?></td>
                            <td><?php echo $borrow['last_date']; ?></td>
                            <td><?php 
                                $today =  date("Y-m-d"); 
                                $lastDate = $borrow['last_date'];
                                
                                if($today>$lastDate){
                                    echo "<strong class='text-danger'>Due date passed</strong>";
                                }else{
                                    echo "<strong class='text-sucess'>On process</strong>";                              
                                }
                            ?></td>
                        </tr>   
                        <?php  $i++; }?>
                                    
                    </tbody>
                </table>                
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">        
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Request book list</h6>
                </div>
                <div class="card-body">                     
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book name</th>
                            <th scope="col">Author name</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=1;
                        foreach($requests as $request){ ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $request['book_name']; ?></td>
                            <td><?php echo $request['author_name']; ?></td>
                            <td><?php echo $request['date']; ?></td>
                        </tr>   
                        <?php  $i++; }?>
                                    
                    </tbody>
                </table>                
                </div>
            </div>
        </div>
    </div>
</div>