$(document).ready(function () {

    // food
    // \/ загрузка определенного меню в таблицу
    $(document).on('click', '#loadMenu', function () {
        var select = $('#menusel :selected').text();
        if (select == "Стандарт+") select = "Плюс";
        console.log(select);
        // var delArray = JSON.stringify(myTableArray);
        $.ajax({
            url: '/admin/load',
            type: 'POST',
            data: "item=" + select,
            success: function (res) {
                var result = JSON.parse(res);
                var options = getOptions();
                var values = getValues();
                var tbody = document.querySelector('table#foodtable tbody');
                tbody.innerHTML = ''; var i = 0;
                result.forEach(el => {
                    var nameProd = 0;
                    for (let index = 0; index < values.length; index++) {
                        if (values[index] === el['foodId']) nameProd = options[index];
                    }
                    if (i == 0) $('#foodtable tbody').prepend(getTr(nameProd, el['1ed'], el['unit'], el['count']));
                    else $('#foodtable tbody').append(getTr(nameProd, el['1ed'], el['unit'], el['count']));
                    i++;
                });
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });

    // редактирование имеющейся строки 
    $(document).on('click', '.add', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        add_upload_line($('#menusel :selected').text(), $(inputs[0]).text(), $(tr).find("td input[name=quant]").val(), $(inputs[2]).text(), $(tr).find("td input[name=quant2]").val(), '/admin/set');
        return false;
    });

    $(document).on('click', '.cancel', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');

        var arrayLine = [];
        arrayLine.push($('#menusel :selected').text());
        arrayLine.push($(inputs[0]).text());
        var delElem = JSON.stringify(arrayLine);
        $.ajax({
            url: '/admin/deletemenu',
            type: 'POST',
            data: { delElem: delElem },
            success: function (res) {
                location.reload();
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });

    // \/ форма добавления записи в текущую таблицу 
    $(document).on('click', '.submit-add', function () {
        add_upload_line($('#menusel :selected').text(), $('#selAdd :selected').text(), $('#inputEdAdd').val(), $('#inputIzAdd').val(), $('#inputCountAdd').val(), '/admin/set');
    });

    function getOptions() {
        var options = [];
        var select = document.querySelectorAll("#selAdd option");
        select.forEach(element => {
            options.push($(element).text());
        });
        return options;
    }

    function getValues() {
        var values = [];
        var select = document.querySelectorAll("#selAdd option");
        select.forEach(element => {
            values.push(element.value);
        });
        return values;
    }

    function getTr(a, b, c, d) {
        var name = '<tr><td><input type="hidden" name="" value="">' + a + '</td>';
        var one = '<td><input class="form-control form-control-sm greenf" name="quant" type="number" min="1" max="10000" value="' + b + '"></td>';
        var unit = '<td contenteditable="true"><input type="hidden" value="">' + c + '</td>';
        var count = '<td><input type="number" class="form-control form-control-sm greenf" name="quant2" value="' + d + '" min="1" max="10000" style="width:100px;" /></td>';
        var buttons = '<td> <a class="btn btn-sm col-auto ms-2 add" title="Сохранить изменения"><img width="20px" src="../images/check.png"></a></td><td> <a class="btn btn-sm col-auto ms-2 cancel" title="Удалить запись"><img width="20px" src="../images/cancel.png"></a></td></tr>';
        return name + one + unit + count + buttons;
    }

    function add_upload_line(a, b, c, d, e, Q) {
        var arrayLine = [];
        arrayLine.push(a);
        arrayLine.push(b);
        arrayLine.push(c);
        arrayLine.push(d);
        arrayLine.push(e);

        console.log(arrayLine);
        var text = JSON.stringify(arrayLine);
        $.ajax({
            url: Q,
            type: 'POST',
            data: { text: text },
            success: function (res) {
                location.reload();

            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    };

    // equipment
    $(document).on('click', '.submit-add-eq', function () {
        var w = document.querySelectorAll('.eqLineAdd div input');

        console.log($(w[0]).val());
        console.log($(w[1]).val());
        console.log($(w[2]).val());
        if ($(w[0]).val() == "" || $(w[1]).val() == "" || $(w[2]).val() == "")
            alert("Форма заполнена некорректно");
        else {
            if (Number($(w[2]).val()) > Number($(w[1]).val())) { alert('Превышено используемое число единиц снаряжения'); }
            else {
                var arrayLine = [];
                arrayLine.push($(w[0]).val());
                arrayLine.push($(w[1]).val());
                arrayLine.push($(w[2]).val());
                var eq = JSON.stringify(arrayLine);
                $.ajax({
                    url: '/admin/addequipm',
                    type: 'POST',
                    data: { eq: eq },
                    success: function (res) {
                        location.reload();
                    },
                    error: function (exeption) {
                        alert('Ошибка сохранения...');
                    }
                });
                return false;
            }
        }
    });

    $(document).on('click', '.addEq', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        console.log();
        var text = $(inputs[1]).text();
        var num1 = $(inputs[2]).find("input").val();
        var num2 = $(inputs[3]).find("input").val();
        if (text == "" || num1 == "" || num2 == "") {
            alert("Форма заполнена некорректно"); location.reload();
        }
        else {
            if (Number(num2) > Number(num1)) { alert('Превышено используемое число единиц снаряжения'); }
            else {
                var arrayLine = [];
                arrayLine.push($(inputs[0]).text());
                arrayLine.push(text);
                arrayLine.push(num1);
                arrayLine.push(num2);
                var row = JSON.stringify(arrayLine);
                $.ajax({
                    url: '/admin/addrow',
                    type: 'POST',
                    data: { row: row },
                    success: function (res) {
                        location.reload();
                    },
                    error: function (exeption) {
                        alert('Ошибка сохранения...');
                    }
                });
                return false;
            }
        }
    });

    $(document).on('click', '.cancelEq', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        $.ajax({
            url: '/admin/deleteeq',
            type: 'POST',
            data: "id=" + $(inputs[0]).text(),
            success: function (res) {
                location.reload();
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });

    $(document).on('click', '.submit-add-cat', function () {
        var w = document.querySelector('.CatLineAdd div input');
        if ($(w).val() == "")
            alert("Форма заполнена некорректно");
        $.ajax({
            url: '/admin/addcat',
            type: 'POST',
            data: "cat=" + $(w).val(),
            success: function (res) {
                location.reload();
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;

    });

    $(document).on('click', '.addCat', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        if ($(inputs[1]).text() == "") { alert("Пустое поле!"); }
        else {
            array = [];
            array.push($(inputs[0]).text());
            array.push($(inputs[1]).text());
            var cats = JSON.stringify(array);
            $.ajax({
                url: '/admin/uploadcat',
                type: 'POST',
                data: { cats: cats },
                success: function (res) {
                    location.reload();
                },
                error: function (exeption) {
                    alert('Ошибка сохранения...');
                }
            });
            return false;
        }
    });

    $(document).on('click', '.submit-add-t', function () {
        var w = document.querySelectorAll('.TLineAdd div input');
        if ($(w[0]).val() == "" || $(w[1]).val() == "" || $(w[2]).val() == "")
            alert('Некорректные данные!');
        else {
            var array = [];
            array.push($(w[0]).val());
            array.push($(w[1]).val());
            array.push($(w[2]).val());
            var tour = JSON.stringify(array);
            $.ajax({
                url: '/admin/addtour',
                type: 'POST',
                data: { tour: tour },
                success: function (res) {
                    location.reload();
                },
                error: function (exeption) {
                    alert('Ошибка сохранения...');
                }
            });
            return false;
        }
    });

    $(document).on('click', '#Uploadinfo', function () {
        $.ajax({
            url: '/admin/getdate',
            type: 'POST',
            data: 'kred=' + $('#selectTourGroup :selected').val(),
            success: function (res) {
                var array = JSON.parse(res);
                $('select.selectDateGroup').empty();
                array.forEach(element => {
                    $('select.selectDateGroup').append('<option value="' + element['id'] + '">' + element['start'] + ' - ' + element['end'] + '</option>');
                });
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;

    });

    $(document).on('click', '#Wertt', function () {
        $.ajax({
            url: '/admin/getdate',
            type: 'POST',
            data: 'kred=' + $('#selectTourGroup :selected').val(),
            success: function (res) {
                var array = JSON.parse(res);
                $('select.selectDateGroup').empty();
                array.forEach(element => {
                    $('select.selectDateGroup').append('<option value="' + element['id'] + '">' + element['start'] + ' - ' + element['end'] + '</option>');
                });
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;

    });

    $(document).on('click', '#ItemGroupAdd', function () {
        var array = [];
        array.push($('#selectTourGroup :selected').val());
        array.push($('.selectDateGroup :selected').val());
        array.push($('#MaxPeop').val());
        array.push($('#MinPeop').val());
        var ret = JSON.stringify(array);
        console.log(array);
        $.ajax({
            url: '/admin/setgroup',
            type: 'POST',
            data: { ret: ret },
            success: function (res) {
                location.reload();
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;

    });


    $(document).on('click', '.modalGroupOpen', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        console.log($(inputs[0]).text());
        $('#titleModal').text('Группа ' + $(inputs[0]).text());
        $.ajax({
            url: '/admin/getlist',
            type: 'POST',
            data: 'selectedItem=' + $(inputs[0]).text(),
            success: function (res) {
                $('#tableClients tbody').empty();
                var ress = JSON.parse(res);
                var ww = "";
                ress.forEach(el => {
                    if (el['confirm'] == 1) ww = '<input class="form-check-input greenf" type="checkbox" checked>';
                    else ww = '<input class="form-check-input greenf" type="checkbox">';
                    console.log(el['confirm']);
                    $('#tableClients').append('<tr><td>' + el['idClient'] + '</td><td>' + el['count'] + '</td><td>' + el['menuStand'] + '</td><td>' + el['menuPl'] + '</td><td>' + el['menuCh'] + '</td><td>' + ww + '</td></tr>');
                });
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;

    });


    $(document).on('click', '.saveGroup', function () {
        var array = [];
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        if ($(inputs[4]).find('input').val() == "" || $(inputs[5]).find('input').val() == "" || $(inputs[6]).find('input').val() == "") {
            alert('Ошибка ввода');
        }
        else {
            array.push($(inputs[0]).text());
            array.push($(inputs[4]).find('input').val());
            array.push($(inputs[5]).find('input').val());
            array.push($(inputs[6]).find('input').val());
            array.push($('.selectGroup :selected').val());
            var ytr = JSON.stringify(array);
            console.log(ytr);
            $.ajax({
                url: '/admin/groupupload',
                type: 'POST',
                data: { ytr: ytr },
                success: function (res) {
                    // location.reload();
                },
                error: function (exeption) {
                    alert('Ошибка сохранения...');
                }
            });
            return false;
        }
    });


    $(document).on('click', '.showReserv', function () {
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        $.ajax({
            url: '/admin/getroom',
            type: 'POST',
            data: 'room='+$(inputs[0]).text(),
            success: function (res) {
                var resul = JSON.parse(res);
                $('#tableReserv tbody').empty();
                resul.forEach(el => {
                    $('#tableReserv tbody').append('<tr><td>' + el['idCli'] + '</td><td><input type="date" class="form-control form-control-sm greenf" value="'+el['dateIn']+'"></td><td><input type="date" class="form-control form-control-sm greenf" value="'+el['dateOut']+'"></td><td> <a class="btn btn-sm col-auto ms-2 shch" title="Сохранить изменения"><img width="20px" src="../images/check.png"></a></td><td> <a class="btn btn-sm col-auto ms-2 shcn" title="Удалить запись"><img width="20px" src="../images/cancel.png"></a></td></tr>');               
                });
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });
});
