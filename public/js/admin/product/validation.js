var validation = {
    name : {
        required: true,
        messages : {
            required : 'bắt buộc phải điền tên sản phẩm'
        }
    },
    price : {
        required: true,
        messages : {
            required : 'bắt buộc phải điền giá niêm yết'
        }
    },
    iprice : {
        required: true,
        messages : {
            required : 'bắt buộc phải điền giá nhập để tính lợi nhuận'
        }
    },

    category: {
        min: 1,
        messages: {
            min: 'Vui lòng chọn danh mục'
        }
    },

    "items[idx][iprice]" : {
        required: true,
        messages: {
            required: 'Vui lòng nhập giá nhập để tính lợi nhuận'
        }
    },

    "items[idx][price]" : {
        required: true,
        messages: {
            required: 'Vui lòng nhập giá nhập để tính lợi nhuận'
        }
    },

    "items[idx][quantity]" : {
        min: 1,
        messages: {
            min: 'Giá trị nhỏ nhất bằng 1'
        }
    },


};