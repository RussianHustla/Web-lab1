$(document).ready(function () {

    let x = undefined;
    let r = undefined;
    let y = undefined;

    $('.btn-x').on('click', function () {
        x = Number($(this).text());
        $('.btn-x').removeClass('selected-x');
        $(this).addClass('selected-x');
        // alert("тип: " + typeof(x) + ", значение: " + x);
    })

    $('#check-btn').on('click', function () {

        // alert("Salam alekuum!");

        r = $('#select-r').val();

        let value = $('#input-y').val().replace(',','.').trim();
        if (value != '') {
            value = Number(value);
            if (value >= -3 && value <= 3) {
                // alert('OK');
                // return;
                y = value;
            } else {
                alert("Введен некорректный Y");
                $('#input-y').val('');
                return;
            }
        }

        if (y != undefined && x != undefined && r != undefined) {
            // alert("x = " + x + ", y = " + y + ", r = " + r);
            $.ajax ({
                url: 'check.php',
                type: 'GET',
                cache: false,
                data: {'r': r, 'x': x, 'y': y},
                dataType: 'html',
                success: function (data) {
                    // alert(data);
                    document.getElementById("output").innerHTML = data;
                }
            })
        } else {
            alert("Не все поля заполнены");
        }
        // alert("тип: " + typeof(value) + ", значение: " + value);
    })
})