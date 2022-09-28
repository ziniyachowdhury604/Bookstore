<?php    
    include '../backend/function.php';        
    $data = select("users");
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All users list</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User list</h6>
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
                                                Name</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 176px;">
                                                Mobile number</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 176px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 176px;">Role</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 126px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 107px;">Action</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php 
                                    if($data->num_rows>0){
                                        $i=1;
                                        while($row = $data->fetch_assoc()){ ?>
                                            <tr class="odd">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['role']; ?></td>
                                                <td><?php echo $row['status']==1?"active":'Inactive'; ?></td>
                                                <?php if($row['role']=="admin"){ ?>
                                                    <td>Disabled</td>                  
                                                <?php }else{ ?>
                                                    <td><a href="../backend/edit-user.php?user_id=<?php echo $row['id']; ?>&find=find">edit</a> | <a href="../backend/delete-user.php?user_id=<?php echo $row['id']; ?>&find=find">delete</a></td>
                                                <?php } ?>
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