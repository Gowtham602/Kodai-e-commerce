// ============================
// CATEGORY FILTER (MULTI)
// ============================
import { Toast } from 'bootstrap';
$(document).on('change', '.category-filter, #sortBy', function () {

    let categories = [];
    $('.category-filter:checked').each(function () {
        categories.push($(this).val());
    });

    let sort = $('#sortBy').val();

    $.ajax({
        url: window.appConfig.routes.filterProducts,
        method: "GET",
        data: { categories, sort },
        success: function (products) {

            let html = '';

            if (!products.length) {
                html = `<div class="col-12 text-center text-muted py-5">
                            No products found
                        </div>`;
            } else {
                products.forEach(product => {
                    html += productCard(product);
                });
            }

            $('#product-list').html(html);
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Filter failed');
        }
    });
});


// ============================
// ADD TO CART
// ============================
$(document).on('click', '.add-to-cart', function () {

    let btn = $(this);
    let name = btn.data('name');

    //  Disable button immediately (prevent double click)
    btn.prop('disabled', true);

    $.ajax({
        url: window.appConfig.routes.addToCart,
        method: "POST",
        data: {
            _token: window.appConfig.csrf,
            id: btn.data('id'),
            name: name,
            price: btn.data('price'),
            image: btn.data('image')
        },
        success: function (res) {
            $('#toastText').text(`${name} added to cart`);
            showCartToast();
            $('#cart-count').text(res.count);
        },
        complete: function () {
            //  Re-enable button after 1 second
            setTimeout(() => {
                btn.prop('disabled', false);
            }, 2000);
        }
    });
});

// SHOW TOAST
function showCartToast() {                          
    const toastEl = document.getElementById('cartToast');
    const toast = new Toast(toastEl, {
        delay: 2000
    });
    toast.show();
}

// ============================
// PRODUCT CARD TEMPLATE
// ============================
function productCard(product) {
    return `
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card product-card h-100 shadow-sm border-0">

            <img src="/storage/${product.image}" class="card-img-top">

            <div class="card-body d-flex flex-column">
                <small>${product.category.name}</small>
                <h6 class="fw-bold mt-1">${product.name}</h6>
                <p>${product.weight}</p>
                <h5 class="text-success">₹${product.price}</h5>

                <button class="btn btn-success mt-auto w-100 add-to-cart"
                    data-id="${product.id}"
                    data-name="${product.name}"
                    data-price="${product.price}"
                    data-image="${product.image}">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>`;
}
