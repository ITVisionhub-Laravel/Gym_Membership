$(".add-to-cart").click(function (event) {
    event.preventDefault();
    var name = $(this).data("name");
    var price = Number($(this).data("price"));
    shoppingCart.addItemToCart(name, price, 1);
    displayCart();
});

// Clear items
$(".clear-cart").click(function () {
    shoppingCart.clearCart();
    displayCart();
});

function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for (var i in cartArray) {
        output +=
            "<tr>" +
            "<td>" +
            cartArray[i].name +
            "</td>" +
            "<td>(" +
            cartArray[i].price +
            ")</td>" +
            "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" +
            cartArray[i].name +
            ">-</button>" +
            "<input type='number' class='item-count form-control' data-name='" +
            cartArray[i].name +
            "' value='" +
            cartArray[i].count +
            "'>" +
            "<button class='plus-item btn btn-primary input-group-addon' data-name=" +
            cartArray[i].name +
            ">+</button></div></td>" +
            "<td><button class='delete-item btn btn-danger' data-name=" +
            cartArray[i].name +
            ">X</button></td>" +
            " = " +
            "<td>" +
            cartArray[i].total +
            "</td>" +
            "</tr>";
    }
    $(".show-cart").html(output);
    $(".total-cart").html(shoppingCart.totalCart());
    $(".total-count").html(shoppingCart.totalCount());
}

// Delete item button

$(".show-cart").on("click", ".delete-item", function (event) {
    var name = $(this).data("name");
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
});

// -1
$(".show-cart").on("click", ".minus-item", function (event) {
    var name = $(this).data("name");
    shoppingCart.removeItemFromCart(name);
    displayCart();
});
// +1
$(".show-cart").on("click", ".plus-item", function (event) {
    var name = $(this).data("name");
    shoppingCart.addItemToCart(name);
    displayCart();
});

// Item count input
$(".show-cart").on("change", ".item-count", function (event) {
    var name = $(this).data("name");
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
});
