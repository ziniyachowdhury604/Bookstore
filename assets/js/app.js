// Borrow book
$('.borrowBook').click(function(event) {
    let name = $(this).siblings('h3').html();
    let author = $(this).siblings('.author').html();
    let data = [name, author];
    let thisValue = $(this);
    $.ajax({
        type: "POST",
        data: { data: data },
        url: "http://localhost/bookstore/backend/borrowbook.php",
        success: function(data) {
            if (data == "login") {
                window.location.href = "/bookstore/pages/login.php";
            } else {
                thisValue.siblings('.borrow_book').removeClass('d-none');
            }
        }
    });
});

let cartData = JSON.parse(sessionStorage.getItem('shoppingCart'));
if (cartData != null) {
    let length = parseInt(cartData.length) - 1;
    while (length >= 0) {
        let name = cartData[length].name.split('_').join(' ');
        $('.product-name').each(function() {
            let book_name = $(this).children('h3').html();
            if (book_name == name) {
                $(this).children('.cart').addClass('disabled')
            }
        })
        length--;
    }
}


// Add item
$('.cart').click(function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    var id = $(this).data('id');
    var price = Number($(this).data('price'));
    var quantity = Number($(this).data('quantity'));
    var quantity = parseInt($(this).siblings('.quantity').children('.quantity_item').html());
    $(this).addClass('disabled')
    shoppingCart.addItemToCart(name, price, 1, quantity - 1,id);
    displayCart();
});



var shoppingCart = (function() {

    cart = [];

    // Constructor
    function Item(name, price, count, quantity,id) {
        this.name = name;
        this.price = price;
        this.count = count;
        this.quantity = quantity;
        this.id = id;
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
    }


    var obj = {};

    // Add to cart
    obj.addItemToCart = function(name, price, count, quantity,id) {

        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].count++;
                cart[item].quantity--;
                cart[item].id;
                saveCart();
                return;
            }
        }
        var item = new Item(name, price, count, quantity,id);
        cart.push(item);
        saveCart();
    }

    // Set count from item
    obj.setCountForItem = function(name, count) {
        for (var i in cart) {
            if (cart[i].name === name) {
                cart[i].count = count;
                break;
            }
        }
    };

    // Remove item from cart
    obj.removeItemFromCart = function(name) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].count--;
                cart[item].quantity++;
                if (cart[item].count === 0) {
                    $('.product-name').each(function() {
                        let book_name = $(this).children('h3').html();
                        if (book_name == name.split('_').join(' ')) {
                            $(this).children('.cart').removeClass('disabled')
                        }
                    })
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }




    // Count cart 
    obj.totalCount = function() {
        var totalCount = 0;
        for (var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for (var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for (i in cart) {
            item = cart[i];
            itemCopy = {};
            for (p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    }

    return obj;
})();


function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for (var i in cartArray) {
        if (cartArray[i].quantity <= 0) {
            output += "<tr>" +
                "<td style='max-width:180px; overflow:hidden;'>" + cartArray[i].name + "</td>" +
                "<td>(" + cartArray[i].price + ")</td>" +
                "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>" +
                "<input type='text' disabled class='item-count form-control' data-name='" + cartArray[i].name + "' data-quantity='" + cartArray[i].quantity + "' value='" + cartArray[i].count + "'>" +
                "<button class='plus-item btn btn-primary input-group-addon disabled' data-name=" + cartArray[i].name + ">+</button></div></td>" +
                " = " +
                "<td>" + cartArray[i].total + "</td>" +
                "</tr>";
        } else {
            output += "<tr>" +
                "<td style='max-width:180px; overflow:hidden;'>" + cartArray[i].name + "</td>" +
                "<td>(" + cartArray[i].price + ")</td>" +
                "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>" +
                "<input type='text' disabled class='item-count form-control' data-name='" + cartArray[i].name + "' data-quantity='" + cartArray[i].quantity + "' value='" + cartArray[i].count + "'>" +
                "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>" +
                " = " +
                "<td>" + cartArray[i].total + "</td>" +
                "</tr>";
        }

    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCart(name);

    displayCart();
})

// +1
$('.show-cart').on("click", ".plus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.addItemToCart(name);
    displayCart();
})


displayCart();


$('.orderNowBtn').click(function() {
    window.location.href = "/bookstore/pages/order.php"
})

$('.requestBook').click(function() {

    let name = $(this).siblings('h3').html();
    let author = $(this).siblings('.author').html();
    let id = $(this).siblings('.bookId').val();
    window.location.href = "/bookstore/pages/requestforbook.php?bookname=" + name + "&&authorName=" + author + "&&bookId=" + id;
})