<?php    
    include '../backend/function.php';        
    $data = select("borrow_book");
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Borrow Book list</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Book list</h6>
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
                                                style="max-width: 200px;">
                                                Book Name</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 200px;">
                                                Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">Assign Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">Return Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">Status</th>
                                            
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php 
                                    if($data->num_rows>0){
                                        $i=1;
                                        while($row = $data->fetch_assoc()){ ?>
                                            
                                            <tr class="odd">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['book_name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo explode(" ",$row['assign_date'])[0]; ?></td>
                                                <td><?php echo $row['last_date']; ?></td>
                                                <td>
                                                <?php 
                                                    date_default_timezone_set("Asia/Dhaka");
                                                    $checkDate = date_diff(date_create($row['last_date']),date_create(date("Y-m-d")));
                                                    if((int) $checkDate->format("%R%a")>=0){
                                                        echo abs((int) $checkDate->format("%R%a")). " days over";
                                                    }else{
                                                        echo abs((int) $checkDate->format("%R%a")). " days left";
                                                    }
                                                ?>
                                                </td>
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