<?php 
    require '../layout/header.php';
    require '../layout/startSection.php';
    require '../layout/navbar.php';
    require '../backend/dbconnect.php';
    
    $conn = OpenCon();
    $url = $_SERVER['REQUEST_URI'];
    
    $bookList = [];    
    
    $sql = 'SELECT * FROM `books` ORDER BY price ASC';
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($bookList,$row);      
        }
    }   
 ?>
<section style="min-height: 83vh; margin-top:60px">
   <div class="container pt-5">
        <div class="row">
            <div class="col-12 bg-primary text-light">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-4">
                        <h3 class="p-3 mb-0 text-center">Book List</h3>
                    </div>
                    <div class="col-12 d-flex justify-content-start justify-content-sm-end gap-3 gap-sm-5 col-sm-8 flex-wrap">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-light" role="button" id="priceSortList" data-bs-toggle="dropdown" aria-expanded="false">
                                Price low to high
                            </a>
                            <ul class="dropdown-menu mt-3" aria-labelledby="priceSortList">
                                <li><a class="dropdown-item" data-parent="price" data-value="low">Price low to high</a></li>
                                <li><a class="dropdown-item" data-parent="price" data-value="high">Price high to low</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle text-light" role="button" id="discountSortList" data-bs-toggle="dropdown" aria-expanded="false">
                                Discount
                            </a>
                            <ul class="dropdown-menu mt-3" aria-labelledby="discountSortList">
                                <li><a class="dropdown-item" data-parent="discount" data-value="10">10% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="20">20% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="30">30% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="40">40% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="50">50% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="60">60% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="70">70% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="80">80% Discounts</a></li>
                                <li><a class="dropdown-item" data-parent="discount" data-value="90">90% Discounts</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle text-light" role="button" id="categorySortList" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu mt-3" aria-labelledby="categorySortList">
                                <li><a class="dropdown-item" data-parent="category" data-value="Comic">Comic Book</a></li>
                                <li><a class="dropdown-item" data-parent="category" data-value="Fantasy">Fantasy</a></li>
                                <li><a class="dropdown-item" data-parent="category" data-value="Classics">Classics</a></li>
                                <li><a class="dropdown-item" data-parent="category" data-value="Historical">Historical Fiction</a></li>
                                <li><a class="dropdown-item" data-parent="category" data-value="Horror">Horror</a></li>
                                <li><a class="dropdown-item" data-parent="category" data-value="Love">Love Story</a></li>
                                <li><a class="dropdown-item" data-parent="category" data-value="Science">Science Fiction (Sci-Fi)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-3 filterSection">
                
            </div>
        </div>
   </div>
   <div class="container">
        <div class="row bookRow">
        </div>
    </div>
</section>

<?php     
    require '../layout/endSection.php';
?>

    <!-- Jquery 3.6.0 js -->
    <script src="../../bookstore/assets/js/jquery3.6.0.js"></script>
    
    <script type="text/javascript">
        let bookLists = <?php echo json_encode($bookList); ?>;
        let filters = window.location.href;
        
        $(".dropdown-menu li a").click(function(){
            filters[$(this).attr("data-parent")] = $(this).attr("data-value");
        })
        let filter={};
        
        if(filters.includes("?")){
            filter[filters.split("?")[1].split("=")[0]]=filters.split("?")[1].split("=")[1];
        }
        
        $('.dropdown-menu li a').click(function(value){
            filter={};
            filter[$(this).attr("data-parent")]=$(this).attr("data-value");
            showValue(filter);        
        })
        
        function showValue(filter){
            let filterMarkup='';        
            for(let f in filter){            
                filterMarkup+=`
                    <span class="p-2 bg-warning rounded-3" style="font-size: 12px;">${f} : ${filter[f]}</span>
                `;
            }
            $('.filterSection').empty();
            $('.filterSection').append(filterMarkup);
            var filteredArray = bookLists;
            
            if(Object.keys(filter).length>0){
                for(let data in filteredArray){
                    if(Object.keys(filter)!="price"){                    
                        filteredArray = filteredArray.filter(function(e) { return e[Object.keys(filter)] == filter[Object.keys(filter)] })
                    }                
                    if(filter['price']=='high'){
                        filteredArray.sort((a, b) => parseInt(b.price) - parseInt(a.price));
                    }              
                    if(filter['price']=='low'){
                        filteredArray.sort((a, b) => parseInt(a.price) - parseInt(b.price));
                    }
                }             
            }        
            
            $('.bookRow').empty();
            
            if(Object.keys(filteredArray).length>0){
                for( let book in filteredArray){
                    let bookTemplate = `
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a class="d-block text-center mb-4">
                                <div class="product-list">
                                    <div class="product-image position-relative">
                                        <img src="../admin/uploads/${filteredArray[book].images}" alt="products"
                                            class="img-fluid product-image-first" style="height:300px;">
                                            <span class="position-absolute px-3 py-2 fw-bolder rounded-3 discountShow ${(filteredArray[book].discount==0)?"d-none":""}">${filteredArray[book].discount} % <span style='font-size:10px'>Discount</span></span></span>
                                    </div>
                                    <div class="product-name pt-3">    
                                        <h3 class="text-capitalize" style="height:40px; overflow:hidden">${filteredArray[book].book_name}</h3>
                                        <p class="mb-1 author">${filteredArray[book].author_name}</p>
                                        <p class="mb-1 amount">৳ ${(parseInt(filteredArray[book].discount)!=0)?filteredArray[book].price - filteredArray[book].price*filteredArray[book].discount/100 +"<del> ৳ "+filteredArray[book].price+"</del>":filteredArray[book].price}</p>
                                        <p class="mb-1 quantity"><strong>Quantity: </strong> <span class="quantity_item"> ${filteredArray[book].quantity} </span></p>
                                        <p class="d-block my-2 text-dark bg-info mx-4 rounded-3 d-none borrow_book">Borrow request success</p>`;
                    
                                    if(filteredArray[book].quantity>0){
                                        bookTemplate+= `
                                        <button type="button" data-name="${filteredArray[book].book_name.split(' ').join('_')}" data-price="${(parseInt(filteredArray[book].discount)!=0)?filteredArray[book].price - filteredArray[book].price*filteredArray[book].discount/100:filteredArray[book].price}" data-quantity="${filteredArray[book].quantity}" data-id="${filteredArray[book].id}" class="cart btn btn-success mb-3">Add to cart</button>
                                        <button type="button" class="btn btn-primary mb-3 borrowBook">Borrow book</button>                                        
                                    </div>
                                </div>
                            </a>            
                        </div>        
                    `;
                    }else{ 
                        bookTemplate+=`                       
                        <input type="hidden" class="bookId" value="${filteredArray[book].id}" />
                            <button type="button" class="btn btn-warning mb-3 mt-3 requestBook">Request book</button>
                        </div>
                    </div>
                </a>            
            </div> 
            `;                   
        }
        $('.bookRow').append(bookTemplate);
        }
    }else{
        $('.bookRow').append(`
            <div class="alert alert-danger mt-5" role="alert">
            No books found
            </div>`);                
    }
}    
        
        showValue(filter);
        ;        
        
    </script>
        
    
    
<?php
    require '../layout/footer.php';
?>