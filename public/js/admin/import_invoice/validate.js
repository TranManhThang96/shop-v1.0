var form = $('#frm');
form.validate();

var validation = {
    "items[idx][iprice_temp]": {
        required: true,
        messages: {
            required: 'Vui lòng nhập giá nhập để tính lợi nhuận'
        }
    },

    "items[idx][quantity]": {
        required: true,
        digits: true,
        min: 1,
        messages: {
            required: 'Vui lòng nhập giá nhập để tính lợi nhuận',
            digits: 'Chỉ chấp nhận số nguyên',
            min: 'Số lượng ít nhất là 1'
        }
    },
};

function validateInput() {
    $('#product').find('tr').each(function () {
        let id = $(this).data('id');
        $("[name='items[" + id + "][iprice_temp]']").rules("add", validation['items[idx][iprice_temp]']);
        $("[name='items[" + id + "][quantity]']").rules("add", validation['items[idx][quantity]']);
    });
}

$("#submit-template").click(function () {
    validateInput()
    if (form.valid()) {
        return true;
    }
    return false;
})
