$(document).ready(function () {
    //goi ham format gia tri limit,discount khi moi khoi tao
    formatLimit();
    formatDiscount();

    $("input[name=type]").on('click', function () {
        if ($(this).is(':checked')) {
            if ($(this).val() == 1) {
                $('.discount').text('$')
            } else {
                $('.discount').text('%')
            }
        }
        $('#discount').val('');
    })

    function formatLimit() {
        let limit = $('#limit');
        let str = limit.val();
        if (str != '') {
            let price = str.replace('.', '').trim();
            if (price == '0') {
                price = '1'
            }
            let price_value = price.replace(/ |\D/gi, '');
            let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            limit.val(price_format);
        }
    }

    function formatDiscount() {
        let discount = $('#discount');
        let str = discount.val();
        if (str != '') {
            if ($("input[name=type]:checked").val() == 1) {
                let price = str.replace('.', '').trim();
                if (price == '0') {
                    price = '1'
                }
                let price_value = price.replace(/ |\D/gi, '');
                let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                discount.val(price_format);
            } else {
                let val = parseInt(str);
                if (val == NaN) {
                    discount.val('');
                } else {
                    if (val > 100 || val < 0)
                        discount.val('');
                }
            }
        }
    }

    $('#limit').on('keyup', function ($event) {
        let str = event.target.value;
        let price = str.replace('.', '').trim();
        if (price == '0') {
            price = '1'
        }
        let price_value = price.replace(/ |\D/gi, '');
        let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        event.target.value = price_format;
    })

    $('#discount').on('keyup', function ($event) {
        let str = event.target.value;
        if ($("input[name=type]:checked").val() == 1) {
            let price = str.replace('.', '').trim();
            if (price == '0') {
                price = '1'
            }
            let price_value = price.replace(/ |\D/gi, '');
            let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            event.target.value = price_format;
        } else {
            let val = parseInt(str);
            if (val == NaN) {
                $('#discount').val('');
            } else {
                if (val > 100 || val < 0)
                    $('#discount').val('');
            }
        }
    })
})
