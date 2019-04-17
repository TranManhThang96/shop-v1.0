var form = $('#frm');
form.validate();

function validateInput() {
    var check = 1;
    $.getScript('../../js/admin/product/validation.js', function () {
        for (key in validation) {
            $('[name="' + key + '"]').rules('add', validation[key]);
        }
        $('#product-item').find('tr').each(function () {
            let id = $(this).data('id');
            $("[name='items[" + id + "][iprice]']").rules("add", validation['items[idx][iprice]']);
            $("[name='items[" + id + "][price]']").rules("add", validation['items[idx][price]']);
            $("[name='items[" + id + "][quantity]']").rules("add", validation['items[idx][quantity]']);
        });
    }).done(function () {
        if (form.valid())
            check =  true;
        else
            check = false;
        check = 2;
        console.log(check);
    },check);
    return check;
}

$("#submit-template").click(function () {
    console.log(validateInput());
    return false;
})


$('#category').select2();
$('#brand').select2();
$('#discount').select2();