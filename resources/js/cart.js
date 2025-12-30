import { Toast } from 'bootstrap';

// FILTER & SORT
$(document).on('change', '.category-filter, #sortBy', function () {

    let categories = $('.category-filter:checked')
        .map(function () { return $(this).val(); })
        .get();

    let sort = $('#sortBy').val();

    $.get(window.appConfig.routes.filterProducts, { categories, sort }, function (response) {

        let products = response.products;

        let html = products.length
            ? products.map(productCard).join('')
            : `<div class="col-12 text-center text-muted py-5">No products found</div>`;

        $('#product-list').html(html);

        // pagination (if you are using it)
        if ($('#pagination-wrapper').length) {
            $('#pagination-wrapper').html(response.pagination);
        }
    });
});


// ADD TO CART
$(document).on('click', '.add-to-cart', function () {

    let btn = $(this);
    btn.prop('disabled', true);

    $.post(window.appConfig.routes.addToCart, {
        _token: window.appConfig.csrf,
        id: btn.data('id'),
        name: btn.data('name'),
        price: btn.data('price'),
        image: btn.data('image')
    }, function (res) {
        $('#toastText').text(`${btn.data('name')} added to cart`);
        new Toast(document.getElementById('cartToast'), { delay: 2000 }).show();
        $('#cart-count').text(res.count);
        $('#cart-count-mobile').text(res.count);
    }).always(() => {
        setTimeout(() => btn.prop('disabled', false), 1500);
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
    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
        <div class="card product-card h-100 border-0">

            <div class="product-img-wrapper">
                <img src="/storage/${product.image}" alt="${product.name}">
                <span class="badge bg-success product-badge">Fresh</span>
            </div>

            <div class="card-body d-flex flex-column p-4">
                <small class="text-muted text-uppercase category">
                    ${product.category.name}
                </small>

                <h6 class="product-title mt-1">
                    ${product.name}
                </h6>

                <p class="product-weight mb-2">
                    ${product.weight}
                </p>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="product-price mb-0">
                        ₹${product.price}
                    </h5>
                
                </div>

                <button class="btn btn-success add-to-cart mt-auto w-100 "
                    data-id="${product.id}"
                    data-name="${product.name}"
                    data-price="${product.price}"
                    data-image="${product.image}">
                    🛒 Add to Cart
                </button>
            </div>
        </div>
    </div>`;
}

//pagination also admin product also 
$(document).on('click', '.pagination a', function (e) {
    // e.preventDefault();

    let page = $(this).attr('href').split('page=')[1];
    loadProducts(page);
});

function loadProducts(page = 1) {

    let categories = $('.category-filter:checked')
        .map(function () { return $(this).val(); })
        .get();

    let sort = $('#sortBy').val();

    $.get(window.appConfig.routes.filterProducts, {
        categories,
        sort,
        page
    }, function (res) {

        let html = res.products.length
            ? res.products.map(productCard).join('')
            : `<div class="col-12 text-center text-muted py-5">No products found</div>`;

        $('#product-list').html(html);
        $('#pagination-wrapper').html(res.pagination);
    });
}
