$(document).ready(function () {
    if (!$('#stickyCartBar').length) return;

    $.get(window.appConfig.routes.summary, function (res) {
        updateStickyCart(res);
    });
});



// ➕➖ QTY UPDATE (EVENT DELEGATION)
$(document).on('click', '.qty-plus, .qty-minus', function () {

    let btn = $(this);
    let id = btn.data('id');
    let change = btn.hasClass('qty-plus') ? 1 : -1;
    let card = btn.closest('.cart-item');

    $.post(window.appConfig.routes.updateCart, {
        _token: window.appConfig.csrf,
        id,
        change
    }, function (res) {

        if (!res.items || !res.items[id]) return;

        let item = res.items[id];

        card.find('.qty-value').text(item.qty);
        card.find('.item-total').text('₹' + (item.qty * item.price));

        $('#subtotal').text('₹' + res.subtotal);
        $('#total').text('₹' + res.subtotal);

        $('#cart-count').text(res.count);
        $('#cart-count-mobile').text(res.count);

        updateStickyCart(res); // 
    });
});


// DELETE ITEM (EVENT DELEGATION)
$(document).on('click', '.delete-item', function () {

    let id = $(this).data('id');
    let card = $(this).closest('.cart-item');

    $.post(window.appConfig.routes.deleteCart, {
        _token: window.appConfig.csrf,
        id
    }, function (res) {

        card.remove();

        $('#subtotal').text('₹' + res.subtotal);
        $('#total').text('₹' + res.subtotal);

        $('#cart-count').text(res.count);
        $('#cart-count-mobile').text(res.count);

        updateStickyCart(res); //  hides when 0
    });
});




// UI UPDATE FUNCTIONS
function updateUI(card, id, res) {
    if (!res.items || !res.items[id]) return;

    let item = res.items[id];

    card.find('.qty-value').text(item.qty);
    card.find('.item-total')
        .text('₹' + (item.qty * item.price));

    updateSummary(res);
}


function updateSummary(res) {
    $('#subtotal').text('₹' + res.subtotal);
    $('#total').text('₹' + res.total);
    // for destop count 
    $('#cart-count').text(res.count);
    // for mobile count 
    $('#cart-count-mobile').text(res.count);
    //  updateStickyCart(res);
}


//stickly  in mobile and all device 
$(document).on('click', '.add-to-cart', function () {

    let btn = $(this);
    if (btn.prop('disabled')) return;
    btn.prop('disabled', true);

    $.post(window.appConfig.routes.addToCart, {
        _token: window.appConfig.csrf,
        id: btn.data('id')
    }, function (res) {

        $('#cart-count').text(res.count);
        $('#cart-count-mobile').text(res.count);

        updateStickyCart(res); // 

        $('#toastText').text('Added to cart');
        new bootstrap.Toast(
            document.getElementById('cartToast'),
            { delay: 1500 }
        ).show();

    }).always(() => btn.prop('disabled', false));
});




  let cartCount = 0;


function updateStickyCart(res) {
    if (!res || res.count <= 0) {
        $('#stickyCartBar').addClass('d-none');
        return;
    }

    $('#stickyCartCount').text(res.count);
    $('#stickySubtotal').text(res.subtotal);
    $('#stickyCartBar').removeClass('d-none');
}





function showSticky(res) {
    if (res.count > 0) {
        $('#stickyCartCount').text(res.count);
        $('#stickyCartBar').removeClass('d-none');
    }
}

function hideSticky() {
    $('#stickyCartBar').addClass('d-none');
}




