// QTY + / - (EVENT DELEGATION)
$(document).on('click', '.qty-plus, .qty-minus', function () {

    let btn = $(this);
    let id = btn.data('id');
    let change = btn.hasClass('qty-plus') ? 1 : -1;
    let card = btn.closest('.cart-item');

    $.ajax({
        url: window.appConfig.routes.updateCart,
        method: 'POST',
        data: {
            _token: window.appConfig.csrf,
            id: id,
            change: change
        },
        success: function (res) {
            updateUI(card, id, res);
        }
    });
});
// DELETE ITEM (EVENT DELEGATION)
$(document).on('click', '.delete-item', function () {

    let btn = $(this);
    let id = btn.data('id');
    let card = btn.closest('.cart-item');

    $.ajax({
        url: window.appConfig.routes.deleteCart,
        method: 'POST',
        data: {
            _token: window.appConfig.csrf,
            id: id
        },
       success: function (res) {

    // remove item card
    card.fadeOut(300, function () {
        $(this).remove();
    });

    // update numbers
    $('#cart-count-mobile').text(res.count);

    $('#cart-count').text(res.count);
    $('#subtotal').text('₹' + res.subtotal);
    $('#total').text('₹' + res.total);

    // 👉 VERY IMPORTANT PART
   if (res.count === 0) {

    $('.col-lg-8').html(`
        <h4 class="fw-bold mb-4">
            Shopping Cart (0)
        </h4>

        <div class="empty-cart-wrapper">
            <div class="empty-cart-card">
                <div class="cart-icon">🛒</div>

                <h3>Your cart is empty</h3>
                <p>Add some delicious products from Kodaikanal!</p>

                <a href="${window.appConfig.routes.products}" class="start-shopping-btn">
                    👜 Start Shopping
                </a>
            </div>
        </div>
    `);

    $('.price-card').hide();
}

}

    });
});

// UI UPDATE FUNCTIONS
function updateUI(card, id, res) {

    if (!res.cart[id]) return;

    let item = res.cart[id];

    card.find('.qty-value').text(item.qty);
    card.find('.item-total').text('₹' + (item.qty * item.price));

    updateSummary(res);
}

function updateSummary(res) {
    $('#subtotal').text('₹' + res.subtotal);
    $('#total').text('₹' + res.total);
    // for destop count 
    $('#cart-count').text(res.count);
    // for mobile count 
    $('#cart-count-mobile').text(res.count);
}
