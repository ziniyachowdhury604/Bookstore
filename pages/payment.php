<?php 
    require '../layout/header.php';
    require '../layout/startSection.php';
?>


<section class="vh-100 d-flex justify-content-center align-items-center">
    <div style="width:400px; height:400px">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header  bg-success text-white">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Order completed</p>
        </div>
        <div class="modal-footer">
            <a href="/bookstore/admin/index.php" class="btn btn-secondary">Go to Dashboard</a>
            <a href="/bookstore/pages/books.php"  class="btn btn-primary">Buy more</a>
        </div>
        </div>
    </div>
    </div>
</section>


<?php     
    require '../layout/endSection.php';
    require '../layout/footer.php';
?>

<script>
    sessionStorage.clear();
</script>  