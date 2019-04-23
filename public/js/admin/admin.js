const PROVINCEDEFAULT = "<option value='0'>-Chọn tỉnh/thành phố-</option>";
const DISTRICTDEFAULT = "<option value='0'>-Chọn quận/huyện-</option>";
const WARDDEFAULT = "<option value='0'>-Chọn xã/phường-</option>";
const DOMAIN = window.location.host;

$('#province').on('change', function () {
    let provinceId = $(this).val();
    if (provinceId > 0) {
        //dung ajax lay danh sach quan/huyen
        $('#district').html("<option value='0'>Loading ...</option>");
        $('#ward').html(WARDDEFAULT);
        $.ajax({
            url: '/admin/district/get-list-district-by-province',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                provinceId: provinceId,
            },
            dataType: 'json',
            success(res) {
                let count = Object.keys(res).length;
                if (count > 0) {
                    let str = '';
                    str += DISTRICTDEFAULT;
                    for (let district of res) {
                        str += "<option value='" + district['id'] + "'>" + district['name'] + "</option>";
                    }
                    $('#district').html(str);
                }
            }
        })
    } else {
        $('#district').html(DISTRICTDEFAULT);
        $('#ward').html(WARDDEFAULT);
    }
})
$('#district').on('change', function () {
    let districtId = $(this).val();
    $('#ward').html("<option value='0'>Loading ...</option>");
    if (districtId > 0) {
        //dung ajax lay danh sach phuong/xa
        $.ajax({
            url: '/admin/ward/get-list-ward-by-district',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                districtId: districtId,
            },
            dataType: 'json',
            success(res) {
                let count = Object.keys(res).length;
                if (count > 0) {
                    let str = '';
                    str += WARDDEFAULT;
                    for (let ward of res) {
                        str += "<option value='" + ward['id'] + "'>" + ward['name'] + "</option>";
                    }
                    $('#ward').html(str);
                }

            }
        })
    } else {
        $('#ward').html(WARDDEFAULT);
    }
})

$('#province').select2();
$('#district').select2();
$('#ward').select2();
$('#category-parent').select2();

$('.show-detail').on('click', function () {
    $(this).parent().next().toggle();
})

$('#per-page').on('change',function () {
    $('#form-search').submit();
})

function _formatNumber(event) {
    let str = event.target.value;
    str = str.replace('.', '').trim();
    if (str == '0') {
        str = '1'
    }
    let value = str.replace(/ |\D/gi, '');
    let format = value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    event.target.value = format;
}

function _formatNumberToMoney(value) {
    return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
}