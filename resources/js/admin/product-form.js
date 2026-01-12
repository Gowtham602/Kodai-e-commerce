export function initProductValidation() {

    if (!window.$ || !$.validator) {
        console.error('jQuery Validation not loaded');
        return;
    }

    // Custom filesize rule
    $.validator.addMethod("filesize", function (value, element, maxSize) {
        if (!element.files || !element.files.length) return true;
        return element.files[0].size <= maxSize;
    });

    function setup(formSelector, isEdit = false) {
        const $form = $(formSelector);

        if (!$form.length) return; //  THIS WAS CRITICAL

        $form.validate({
            ignore: [], //  IMPORTANT (Bootstrap + hidden fields)

            rules: {
                category_id: { required: true },
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                price: {
                    required: true,
                    number: true,
                    min: 1
                },
                weight: {
                    maxlength: 50
                },
                image: {
                    required: !isEdit,
                    extension: "jpg|jpeg|png|webp"
                  
                }
            },

            messages: {
                category_id: "Please select a category",
                name: "Product name is required",
                price: "Enter valid price",
                image: "Invalid image"
            },

            errorElement: "small",
            errorClass: "text-danger",

            highlight(element) {
                $(element).addClass("is-invalid");
            },
            unhighlight(element) {
                $(element).removeClass("is-invalid");
            },

            submitHandler(form) {
                form.submit(); //  THIS MAKES UPDATE WORK
            }
        });
    }

    // CREATE
    setup('#productCreateForm', false);

    // UPDATE
    setup('#productEditForm', true);
}
