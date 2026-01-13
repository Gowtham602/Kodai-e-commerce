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
         toggleEmptyCart(res); 
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

        updateStickyCart(res);

        const bar = $('#stickyCartBar');
        bar.removeClass('sticky-bounce');
        void bar[0].offsetWidth; // reflow
        bar.addClass('sticky-bounce');

        $('#cart-count').text(res.count);
        $('#cart-count-mobile').text(res.count);

    }).always(() => btn.prop('disabled', false));
});

// $(document).on('click', '.add-to-cart', function () {

//     let btn = $(this);
//     if (btn.prop('disabled')) return;
//     btn.prop('disabled', true);

//     $.post(window.appConfig.routes.addToCart, {
//         _token: window.appConfig.csrf,
//         id: btn.data('id')
//     }, function (res) {

//         $('#cart-count').text(res.count);
//         $('#cart-count-mobile').text(res.count);

//         updateStickyCart(res); // 

//         $('#toastText').text('Added to cart');
//         new bootstrap.Toast(
//             document.getElementById('cartToast'),
//             { delay: 1500 }
//         ).show();

//     }).always(() => btn.prop('disabled', false));
// });




  let cartCount = 0;


function updateStickyCart(res) {
    if (!res || res.count <= 0) {
        $('#stickyCartBar').addClass('d-none');
        return;
    }

   const countEl = document.getElementById('stickyCartCount');
    const subtotalEl = document.getElementById('stickySubtotal');

    animateNumber(countEl, Number(countEl.textContent || 0), res.count);
    animateNumber(subtotalEl, Number(subtotalEl.textContent || 0), res.subtotal);
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


// style jsin stickly
$('#stickyCartBar')
    .addClass('pulse')
    .delay(600)
    .queue(function (next) {
        $(this).removeClass('pulse');
        next();
    });
// price updates, it smoothly animates instead of jumping.
function animateNumber(el, start, end, duration = 400) {
    let startTime = null;

    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        el.textContent = value;
        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}
/* =========================
   CART BUBBLE
========================= */
function showCartBubble(text) {
    const bubble = $(`
        <div class="cart-bubble">
            ${text}
        </div>
    `);

    $('body').append(bubble);

    setTimeout(() => bubble.remove(), 800);
}


function toggleEmptyCart(res) {
    if (res.count <= 0 || res.subtotal <= 0) {
        console.log("if");
        // show empty cart UI
        // $('#cartItemsWrapper').addClass('d-none');
        $('#emptyCartWrapper').removeClass('d-none');

        // disable place order
        $('.place-order-btn').prop('disabled', true)
            .text('Cart is empty')
            .removeClass('btn-warning')
            .addClass('btn-secondary');

    } else {
        console.log("else");
        // show cart UI
        $('#cartItemsWrapper').removeClass('d-none');
        $('#emptyCartWrapper').addClass('d-none');
    }
}
