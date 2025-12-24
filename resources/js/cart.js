// ============================
// CATEGORY FILTER (MULTI)
// ============================
$(document).on('change', '.category-filter', function () {

    let categories = [];

    $('.category-filter:checked').each(function () {
        categories.push($(this).val());
    });

    $.ajax({
        url: window.appConfig.routes.filterProducts,
        method: "GET",
        data: { categories },
        success: function (products) {

            $('#product-list').html('');

            if (!products.length) {
                $('#product-list').html('<p class="text-muted">No products found</p>');
                return;
            }

            products.forEach(product => {
                $('#product-list').append(productCard(product));
            });
        }
    });
});

// ============================
// ADD TO CART
// ============================
$(document).on('click', '.add-to-cart', function () {

    $.ajax({
        url: window.appConfig.routes.addToCart,
        method: "POST",
        data: {
            _token: window.appConfig.csrf,
            id: $(this).data('id'),
            name: $(this).data('name'),
            price: $(this).data('price'),
            image: $(this).data('image')
        },
        success: function (res) {
            $('#cart-count').text(res.count);
        }
    });
});

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
