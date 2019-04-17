var form = $('#frm');
form.validate();

var validation = {
    name: {
        required: true,
        messages: {
            required: 'bắt buộc phải điền tên sản phẩm'
        }
    },
    price: {
        required: true,
        messages: {
            required: 'bắt buộc phải điền giá niêm yết'
        }
    },
    iprice: {
        required: true,
        messages: {
            required: 'bắt buộc phải điền giá nhập để tính lợi nhuận'
        }
    },

    cat_id: {
        min: 1,
        messages: {
            min: 'Vui lòng chọn danh mục'
        }
    },

    "items[idx][iprice]": {
        required: true,
        messages: {
            required: 'Vui lòng nhập giá nhập để tính lợi nhuận'
        }
    },

    "items[idx][price]": {
        required: true,
        messages: {
            required: 'Vui lòng nhập giá nhập để tính lợi nhuận'
        }
    },

    "items[idx][quantity]": {
        min: 1,
        messages: {
            min: 'Giá trị nhỏ nhất bằng 1'
        }
    },


};

function validateInput() {
    for (key in validation) {
        $('[name="' + key + '"]').rules('add', validation[key]);
    }
    $('#product-item').find('tr').each(function () {
        let id = $(this).data('id');
        $("[name='items[" + id + "][iprice]']").rules("add", validation['items[idx][iprice]']);
        $("[name='items[" + id + "][price]']").rules("add", validation['items[idx][price]']);
        $("[name='items[" + id + "][quantity]']").rules("add", validation['items[idx][quantity]']);
    });
}

$("#submit-template").click(function () {
   validateInput();
   if(form.valid()) {
       return true;
   }
    return false;
})


$('#category').select2();
$('#brand').select2();
$('#discount').select2();