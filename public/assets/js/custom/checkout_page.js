$('.other_payment').on('click', function () {
    $('#card_form').hide();
    $('.card_input').removeAttr('required');
})

$('.card_payment').on('click', function () {
    $('#card_form').show();
    $('.card_input').prop('required', true);
})

const townshipSelectOnChangeStub = function () {
    console.log('Working with stub : when #township_select value is Aungmyethazan');
    const data = [
        [239, 240, 241, 242, 243, 244, 245],
        {
            "id": 1,
            "type": "myansan",
            "city_id": 9,
            "township_id": 239,
            "area_description": "5 kg အောက်",
            "min_order_total": 4000,
            "delivery_fee": 1300,
            "delivery_charges": [
                {
                    "id": 1,
                    "logistic_id": 1,
                    "type": "Normal",
                    "amount": 1300,
                    "created_at": null,
                    "updated_at": "2022-12-16T04:29:27.000000Z"
                },
                {
                    "id": 2,
                    "logistic_id": 1,
                    "type": "Premium",
                    "amount": 1800,
                    "created_at": null,
                    "updated_at": "2022-12-16T04:29:27.000000Z"
                }
            ]
        }
    ];
    return data;// this return data format is same as response data when #township_select on change
};

$extra_gross_weight_charge = $("input[type='hidden'][name='extra_gross_weight_charge']").val();

$deliveryCalculateMethod = function (data) {
    if ($("input[type='radio'][name='delivery_type']:checked").val() == 'premium') {// when deli type checkbox is premium
        $('#deli_fee').val(data[1].delivery_charges[1].amount);
        $('#delivery_charge').html(Number($extra_gross_weight_charge ?? 0) + data[1].delivery_charges[1].amount);
        $('#order_total').html(Number($('#sub_total').html()) + data[1].delivery_charges[1].amount + Number($extra_gross_weight_charge ?? 0));
    } else {// when deli type checkbox id normal
        $('#deli_fee').val(data[1].delivery_charges[0].amount);
        $('#delivery_charge').html(Number($extra_gross_weight_charge ?? 0) + data[1].delivery_charges[0].amount);
        $('#order_total').html(Number($('#sub_total').html()) + data[1].delivery_charges[0].amount + Number($extra_gross_weight_charge ?? 0));
    }
};

$("input[type='radio'][name='delivery_type']").on('change', function (e) {//normal premium select box
    e.preventDefault();
    let deliverychargeUrl = $('#township_select').children("option:selected").data('get-delivery-charge-url');

    $.ajax({
        type: "GET",
        url: deliverychargeUrl,
        success: function (data) {
            $deliveryCalculateMethod(data);
        }
    });
});

$('#city_select').on('change', function (e) {
    e.preventDefault();

    $("input[type='radio'][name='delivery_type']")[0].checked = true;

    let townshipUrl = $(this).children("option:selected").data('get-township-url');
    $('#deli_fee').val('');

    $to_hide = ['#order_total_container', '#deli_fee_container', '#deli_type'];
    $to_hide.forEach(element => {
        $(element).hide();
    });
    $.ajax({
        type: "Get",
        url: townshipUrl,
        success: function (data) {
            $('#township_select_container').html(data);

            $('#township_select').on('change', function (e) {
                e.preventDefault();

                let deliverychargeUrl = $(this).children("option:selected").data('get-delivery-charge-url');//get url from selected option data

                $.ajax({
                    type: "Get",
                    url: deliverychargeUrl,
                    dataType: "json",
                    success: function (data) {

                        if (data[0].includes(data[1].township_id)) {
                            $('#deli_type').show();//when premium is avaliable
                        } else {
                            $("input[type='radio'][name='delivery_type']")[0].checked = true;
                            $('#deli_type').hide();
                        }

                        $deliveryCalculateMethod(data);

                        $to_show = ['#order_total_container', '#deli_fee_container'];
                        $to_show.forEach(element => {
                            $(element).show();
                        });

                    },
                    error: function (response) {
                        Toast.fire({
                            icon: "error",
                            title: "Something want wrong!",
                        });
                    }
                });
            });
        },
        error: function (response) {
            Toast.fire({
                icon: "error",
                title: "Something want wrong!",
            });
        }
    });
});
