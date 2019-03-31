var form = $('#form-create');
form.validate();
$.getScript('../../js/admin/product/validation.js',function () {
    for(key in validation ) {
        $('[name="'+key+'"]').rules('add',validation[key]);
    }
});

$('#category').select2();