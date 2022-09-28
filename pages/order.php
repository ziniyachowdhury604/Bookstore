<?php 
    session_start();
    if(!isset($_SESSION['success'])){
       header("Location: ../pages/login.php?cart");
    }else{
        if($_SESSION['role']=="admin"){
            header("Location: ../admin/index.php");            
        }
    }
    require '../layout/header.php';
    require '../layout/startSection.php';
    require '../layout/navbar.php';
    require '../backend/dbconnect.php';
    
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $conn = OpenCon();
?>

    <main>
        <div class="container my-5 py-5">            
            <div class="py-5 text-center"><h2>Checkout form</h2>
                <p class="lead">
                    Give Billing & Shipping details properly to complete your order
                </p>
            </div>
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill totalCount"></span>
                    </h4>
                    <ul class="list-group mb-3">                    
                        <li class="list-group-item d-flex justify-content-between list-item">
                            <span>Total (BDT)</span>
                            <strong><span>৳</span> <span class="totalAmount"></span></strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Shipping address</h4>
                    <form action="../backend/payment.php" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" name="f_name" id="firstName" placeholder="" value="" required="" spellcheck="false" data-ms-editor="true">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="l_name" placeholder="" value="" required="" spellcheck="false" data-ms-editor="true">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea cols="15" rows="3" class="form-control" id="address" name="address" placeholder="Address" required="" spellcheck="false" data-ms-editor="true"></textarea>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        
                        <div class="col-md-5 mb-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" name="country" id="country" required="">
                                <option value="" disabled>Choose...</option>
                                <option>Bangladesh</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                            </div>

                            <div class="col-md-4">
                            <label for="state" class="form-label">District</label>
                            <select class="form-select" id="state" name="state" required="">
                                <option value="">Choose...</option>
                                <option>Dhaka</option>
                                <option>Chittagong</option>
                                <option>Barishal</option>
                                <option>Khulna</option>
                                <option>Rajshahi</option>
                                <option>Rangpur</option>
                                <option>Mymensingh </option>
                                <option>Shylet</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" name="zip" id="zip" placeholder="" required="" spellcheck="false" data-ms-editor="true">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                        <h4 class="my-5">Payment</h4>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-dark" id="digital-tab" data-bs-toggle="tab" data-bs-target="#digital_payment" type="button" role="tab" aria-controls="home" aria-selected="true">Digital Payment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-dark" id="cod-tab" data-bs-toggle="tab" data-bs-target="#cod" type="button" role="tab" aria-controls="profile" aria-selected="false">Cash on delivery</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mt-5" id="digital_payment" role="tabpanel" aria-labelledby="digital-tab">
                                <div class="container-fluid px-0">
                                    <div class="row">                                
                                        <div class="col-12">
                                            <div class="payment-images">
                                                <img src="../assets/img/payment/05.png" alt="mobile payment">
                                                <img src="../assets/img/payment/06.png" alt="mobile payment">
                                                <img src="../assets/img/payment/07.png" alt="mobile payment">
                                                <img src="../assets/img/payment/08.png" alt="mobile payment">
                                            </div>
                                        </div>                                
                                        <div class="col-12 col-sm-8  mt-5">
                                            <div class="payment-images">
                                                <h6>Mobile number:</h6>
                                                <input type="hidden" class="digital_hidden" name="delivery_type" value="digital">
                                                <input type="text" name="mobile_number" name="mobile_number" class="digital_input form-control" pattern="[0-9]{11}" required>
                                            </div>
                                        </div>                      
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cod" role="tabpanel" aria-labelledby="cod-tab">
                                <ul class="mt-5">
                                    <div class="container-fluid px-0 mb-5">
                                        <div class="row">                                
                                            <div class="col-12 col-sm-8  mt-5">
                                                <div class="payment-images">
                                                    <h6>Mobile number (For contact):</h6>
                                                    <input type="hidden" class="cod_hidden" value="cod">
                                                    <input type="text" name="mobile_number" class="cod_input form-control" pattern="[0-9]{11}">
                                                </div>
                                            </div>                      
                                        </div>
                                    </div>                                
                                    <li class="mt-2">In Dhaka the product delivery takes 3-5 working days, customers inside Dhaka can also avail same-day delivery service if they are under the Same Day Delivery area. <br>Note: Delivery time will be started after dispatch from Bookstore warehouse.</li>
                                    <li class="mt-2">In case of outside Dhaka 5-8 Workings days is required for proper delivery of the product. It may vary due to Political/Natural disturbances in the country.<br> Note: Delivery time will be started after dispatch from Bookstore warehouse.</li>
                                    <li class="mt-2">As Bookstore rely on third-party logistics partners and vendors for product delivery issue.<br> For any query please contact us at our hotline number is 01768220997 (Everyday 9 am to 11 am) or e-mail us at support@bookstore.com</li>
                                </ul>  
                            </div>
                        </div>
                        
                        <input type="hidden" name="orderId" value="<?php echo substr(str_shuffle($permitted_chars), 0, 15)?>">
                        <input type="hidden" name="bookList" id="bookList" value="">
                        <button class="w-100 mt-5 btn btn-primary btn-lg" name="payment" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php     
    require '../layout/endSection.php';
    require '../layout/footer.php';
?>
<script>
    let cartValue = sessionStorage.getItem('shoppingCart');
    $('#bookList').val(cartValue);
    cartValue = JSON.parse(cartValue)
    if(cartValue!=null){        
        if(cartValue.length != 0){
            let count=0;
            let totalAmount=0;
            let item='';
            for (let cartItem in cartValue){
                count+=cartValue[cartItem].count;
                totalAmount+=cartValue[cartItem].count*cartValue[cartItem].price;
                item+=`<li class="list-group-item d-flex justify-content-between lh-sm">
                        <div style="width:60%; overflow:hidden">
                            <small class="text-muted">${cartValue[cartItem].name.split('_').join(' ')}</small>
                        </div>
                        <span class="text-muted">${cartValue[cartItem].count} x </span>
                        <span class="text-muted">${cartValue[cartItem].count*cartValue[cartItem].price}</span>                        
                            </li>`;
            }
            $('.totalCount').html(count);
            $('.totalAmount').html(totalAmount);
            $(item).insertBefore('.list-item');
            
        }else{
            window.location.href="/bookstore/pages/books.php"
        }
    }else{
        window.location.href="/bookstore/pages/books.php"
    }
    
    $('.nav-link').click(function(){
        let click_id = $(this).attr('id');
        
        if(click_id== "cod-tab"){
            $('#digital_payment .digital_input').removeAttr('name required')
            $('#cod .cod_input').attr({name:'mobile_number', required:'required'})
            $('.digital_hidden').removeAttr('name')
            $('.cod_hidden').attr('name','delivery_type')
        }
        if(click_id== "digital-tab"){
            $('#cod .cod_input').removeAttr('name required')
            $('#digital_payment .digital_input').attr({name:'mobile_number', required:'required'})
            $('.cod_hidden').removeAttr('name')
            $('.digital_hidden').attr('name','delivery_type')
        }
    })
    
</script>