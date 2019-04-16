var form = $('#frm');
form.validate();
$.getScript('../../js/admin/product/validation.js',function () {
    for(key in validation ) {
        $('[name="'+key+'"]').rules('add',validation[key]);
    }
});

$('#category').select2();
$('#brand').select2();
$('#discount').select2();