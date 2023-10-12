$(document).ready(function () {

    $(document).on('click', '#modalOpenBut', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        $('#inputName').val($(inputs[1]).text());
        $('#inputHours').val($(inputs[2]).find('input').val());
        $('#inputPrice').val($(inputs[3]).find('input').val());
        $.ajax({
            url: '/admin/modal',
            type: 'POST',
            data: "tourid=" + $(inputs[0]).text(),
            success: function (res) {
                var ar = JSON.parse(res);
                console.log(ar['one']);
                $('#tableTime tbody').empty();
                var w = 0;
                ar['two'].forEach(element => {
                    w++;
                    if (w == 1) { $('#tableTime tbody').prepend('<tr><td><input type="date" class="form-control greenf" value="' + element['start'] + '"/></td><td><input type="date" class="form-control greenf" value="' + element['end'] + '"/></td><td>' + element['days'] + '</td><td><a class="btn btn-sm col-auto ms-2 deleteTime" title="Удалить запись"><img width="20px" src="../images/cancel2.png"></a></td></tr>'); }
                    else { $('#tableTime tbody').append('<tr><td><input type="date" class="form-control greenf" value="' + element['start'] + '"/></td><td><input type="date" class="form-control greenf" value="' + element['end'] + '"/></td><td>' + element['days'] + '</td><td><a class="btn btn-sm col-auto ms-2 deleteTime" title="Удалить запись"><img width="20px" src="../images/cancel2.png"></a></td></tr>'); }
                });
                var i = 0;
                $('#tableCategory tbody').empty();
                ar['one'].forEach(element => {
                    i++;
                    if (i == 1) { $('#tableCategory tbody').prepend('<tr><td>' + i + '</td><td>' + element + '</td><td><a class="btn btn-sm col-auto ms-2 deleteRow" title="Удалить запись"><img width="20px" src="../images/cancel2.png"></a></td></tr>'); }
                    else { $('#tableCategory tbody').append('<tr><td>' + i + '</td><td>' + element + '</td><td><a class="btn btn-sm col-auto ms-2 deleteRow" title="Удалить запись"><img width="20px" src="../images/cancel2.png"></a></td></tr>'); }

                });
                $('#Routes').text(ar['three']);
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });


        return false;
    });

    $(document).on('click', '#CategoryAdd', function () {
        var array = [];
        array.push($('#inputName').val());
        array.push($('#selectCategory :selected').text());
        var out = JSON.stringify(array);
        $.ajax({
            url: '/admin/addrelcat',
            type: 'POST',
            data: { out: out },
            success: function (res) {
                var tds = document.querySelector('#tableCategory tbody tr:last-child');
                $('#tableCategory tbody').append('<tr><td>' + (Number($(tds).find('td:first-child').text()) + 1) + '</td><td>' + $('#selectCategory :selected').text() + '</td><td><a class="btn btn-sm col-auto ms-2 deleteRow" title="Удалить запись"><img width="20px" src="../images/cancel2.png"></a></td></tr>');

            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;

    });

    $(document).on('click', '#modalDateUpload', function () {
        if ($('#modalDateStart').val() == "" || $('#modalDateEnd').val() == "" || $('#modalDateDays').val() == "") {
            alert('Данные не введены!');
        }
        else {
            var array = [];
            array.push($('#inputName').val());
            array.push($('#modalDateStart').val());
            array.push($('#modalDateEnd').val());
            array.push($('#modalDateDays').val());
            var w = JSON.stringify(array);
            $.ajax({
                url: '/admin/uploaddate',
                type: 'POST',
                data: { w: w },
                success: function (res) {
                    $('#tableTime tbody').append('<tr><td><input type="date" class="form-control greenf" value="' + $('#modalDateStart').val() + '"/></td><td><input type="date" class="form-control greenf" value="' + $('#modalDateEnd').val() + '"/></td><td>' + $('#modalDateDays').val() + '</td><td><a class="btn btn-sm col-auto ms-2 deleteTime" title="Удалить запись"><img width="20px" src="../images/cancel2.png"></a></td></tr>'); 
                },
                error: function (exeption) {
                    alert('Ошибка сохранения...');
                }
            });
            return false;
        }
    });

});


