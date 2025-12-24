


// + / - Quantity
$('.qty-plus, .qty-minus').click(function () {
    let id = $(this).data('id');
    let change = $(this).hasClass('qty-plus') ? 1 : -1;
    let card = $(this).closest('.cart-item');

    $.post('/cart/update', {id, change}, function (res) {
        updateUI(card, id, res);
    });
});

// Delete
$('.delete-item').click(function () {
    let id = $(this).data('id');
    let card = $(this).closest('.cart-item');

    $.post('/cart/delete', {id}, function (res) {
        card.fadeOut(300, () => card.remove());
        updateSummary(res);
    });
});

// UI Update
function updateUI(card, id, res) {
    let item = res.cart[id];
    card.find('.qty-value').text(item.qty);
    card.find('.item-total').text('₹' + (item.qty * item.price));
    updateSummary(res);
}

function updateSummary(res) {
    $('#subtotal').text('₹' + res.subtotal);
    $('#total').text('₹' + res.total);
    $('#cart-count').text(res.count);
}
