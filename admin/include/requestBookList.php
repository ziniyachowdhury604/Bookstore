<?php    
    include '../backend/function.php';        
    $data = select("request_book"); 
    $copyData = array();   
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Request Book list</h1>

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
                                                style="max-width: 200px;">
                                                Book id</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="max-width: 200px;">
                                                Author Name</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 200px;">
                                                Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">Action</th>
                                            
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php 
                                    if($data->num_rows>0){
                                        $i=1;
                                        while($row = $data->fetch_assoc()){ array_push($copyData,$row);?>                                            
                                            <tr class="odd">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['book_name']; ?></td>
                                                <td><?php echo $row['book_id']; ?></td>
                                                <td><?php echo $row['author_name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo explode(" ",$row['date'])[0]; ?></td>
                                                <?php if($row['book_id'] =='no id'){ ?>
                                                    <td><a href="/bookstore/admin/index.php?pagename=add-book" class="btn btn-success">Add Book</a></td>                                    
                                                <?php }else{ ?>
                                                <td><a href="../backend/edit-book.php?book_id=<?php echo $row['book_id']; ?>&find=find" class="btn btn-success">Add Book</a></td>
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
