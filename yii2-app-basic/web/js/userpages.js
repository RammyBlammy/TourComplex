$(document).ready(function () {
    var windowLoc = $(location).attr('pathname');
    if (windowLoc == "/user/index" && $('#mm').val() == 1) {
        $('#staticBackdrop').modal('show');
    };

    $(document).on('click', '#continue', function () {
        var array = [];
        array.push($('#inputF').val());
        array.push($('#inputN').val());
        array.push($('#inputO').val());
        array.push($('#inputD').val());
        array.push($('#inputPh').val());

        var anketa = JSON.stringify(array);
        $.ajax({
            url: '/user/client',
            type: 'POST',
            data: { anketa: anketa },
            success: function (res) {
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });


    $(document).on('click', '#loupe-tours', function () {
        var ere = document.querySelectorAll("div.d-none");
        ere.forEach(element => {
            $(element).removeClass('d-none');
        });
        
        console.log('jhgf');
        var w = document.querySelectorAll('h5.nameoftour');
        var values = [];
        var ids = [];
        w.forEach(el => {
            ids.push($(el).attr('name'));
            values.push($(el).text());
        });
        if ($('input[type="search"]').val() != "") {
            var w = document.querySelectorAll('h5.nameoftour');
            var values = [];
            var ids = [];
            w.forEach(el => {
                ids.push($(el).attr('name'));
                values.push($(el).text());
            });
            for (let index = 0; index < values.length; index++) {
                if (values[index].includes($('input[type="search"]').val()) == false) {
                    $("div[name='" + ids[index] + "']").addClass('d-none');
                };
            }
        }
        else {
            for (let index = 0; index < ids.length; index++) {
                $("div[name='" + ids[index] + "']").removeClass('d-none');
            }
        }
    });

    $(document).on('click', '.searchBut', function () {
        var categ = document.querySelectorAll('li.categories input[type="checkbox"]:checked');
        var dni = document.querySelectorAll('li.daystour input[type="checkbox"]:checked');

        var alls = document.querySelectorAll("div.card");
        alls.forEach(element => {
            $(element).removeClass('d-none');
        });
        var daych = [];
        dni.forEach(element => {
            daych.push($(element).parent().text().replace(/\s+/g, ''));   //выбранные дни
        });
        console.log(daych);
        var ch = [];
        categ.forEach(element => {
            ch.push($(element).parent().text()); // выбранные категории
        });
        var alls = document.querySelectorAll("div.card");
        var rez = [];
        alls.forEach(element => {
            var den = $(element).find('h6.koldnei');
            // if (daych.includes(den.text().replace(/[^0-9]/g, ''))) console.log('has');
            var spans = $(element).find('span.categ');
            var tempArray = [];
            for (let index = 0; index < spans.length; index++) {
                tempArray.push($(spans[index]).text());
            }
            var i = 0;
            ch.forEach(elem => {
                if (tempArray.includes(elem)) {
                    i++;
                }
            });
            if (ch.length == i) {
                console.log('category match!');
                if (daych.length > 0) {
                    if (daych.includes(den.text().replace(/[^0-9]/g, ''))) {
                        console.log('has');
                        rez.push($(element).attr('name'));
                    }
                }
                else rez.push($(element).attr('name'));
            }
        });

        if (rez.length > 0) {
            alls.forEach(element => {
                if (!rez.includes($(element).attr('name'))) {
                    $(element).addClass('d-none');
                }
            });
        }
        else {
            alls.forEach(element => {
                $(element).addClass('d-none');
            });
        }
    });

    $(document).on('click', '.openModalUser', function () {
        $('#sendRequest, #CountPeop, #menu1, #menu2, #menu3').prop('disabled', false);
        $('#sendRequest').removeClass('btn-danger');
        $('#sendRequest').addClass('btn-success');
        $('#startTour, #endTour, #daysTour, #Places').val('----');
        var openedDiv = $("div.card[name='" + $(this).attr('name') + "']");
        $('#UserinputTour').val($(openedDiv).find('.nameoftour').text());
        $('#UserRoutes').val($(openedDiv).find('p.text-truncate').text());
        console.log($(openedDiv).attr('name'));
        $.ajax({
            url: '/user/getdate',
            type: 'POST',
            data: "time=" + $(openedDiv).attr('name'),
            success: function (res) {
                var result = JSON.parse(res);
                var tbody = document.querySelector('table#UserTime tbody');
                tbody.innerHTML = ''; var i = 0;
                result.forEach(el => {
                    if (i == 0) $('#UserTime tbody').prepend('<tr name="' + el['id'] + '"><td>' + el['start'] + '</td><td>' + el['end'] + '</td><td>' + el['days'] + '</td><td><a class="btn btn-sm btn-outline-dark setBron">Забронировать</a></td></tr>');
                    else $('#UserTime tbody').append('<tr name="' + el['id'] + '"><td>' + el['start'] + '</td><td>' + el['end'] + '</td><td>' + el['days'] + '</td><td><a class="btn btn-sm btn-outline-dark setBron">Забронировать</a></td></tr>');
                    i++;
                });
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });


    $(document).on('click', '.setBron', function () {
        $('#sendRequest').prop('disabled', false);
        $('#CountPeop').prop('disabled', false);
        $('#menu1').prop('disabled', false);
        $('#menu2').prop('disabled', false);
        $('#menu3').prop('disabled', false);
        $('#sendRequest').removeClass('btn-danger');
        $('#sendRequest').addClass('btn-success');
        var tr = $(this).parents('tr');
        var inputs = $(tr).find('td');
        $('#startTour').val($(inputs[0]).text());
        $('#hiddenInputId').val($(tr).attr('name'));
        $('#endTour').val($(inputs[1]).text());
        $('#daysTour').val($(inputs[2]).text());
        $.ajax({
            url: '/user/getgroup',
            type: 'POST',
            data: "group=" + $(tr).attr('name'),
            success: function (res) {
                if (res == '-100') {
                    $('#sendRequest').prop('disabled', true);
                    $('#sendRequest').removeClass('btn-success');
                    $('#sendRequest').addClass('btn-danger');
                    $('#Places').val('Набор в группу не осуществляется!');
                    $('#CountPeop').prop('disabled', true);
                    $('#menu1').prop('disabled', true);
                    $('#menu2').prop('disabled', true);
                    $('#menu3').prop('disabled', true);
                }
                else {
                    $('#Places').val(res);
                }
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
        return false;
    });

    $(document).on('click', '#sendRequest', function () {
        if ($('#DangerText').text() != '' || (Number($('#menu1').val()) + Number($('#menu2').val()) + Number($('#menu3').val())) > Number($('#CountPeop').val())) alert('Недопустимое значение');
        else {
            var array = [];
            array.push($('#hiddenInputId').val()); //id date
            array.push($('input#CountPeop').val()); //count people
            array.push($('#menu1').val());
            array.push($('#menu2').val());
            array.push($('#menu3').val());
            var rrt = JSON.stringify(array);
            $.ajax({
                url: '/user/setrequest',
                type: 'POST',
                data: { rrt: rrt },
                success: function (res) {
                    if (res != "error") {
                        alert('Заявка оставлена!');
                        $('#ModalTour').modal('hide');
                    }
                    else alert('Ошибка сохранения...');
                },
                error: function (exeption) {
                    alert('Ошибка сохранения...');
                }
            });

            return false;
        }
    });

    $('input#CountPeop').on('input', function (e) {
        $('#DangerText').text('');
        if ((Number($('#Places').val()) - Number($('input#CountPeop').val())) < 0) {
            $('#DangerText').text("Превышено допустимое количество!")
        }
    });

    $(document).on('click', '#AllowEdit', function () {
        console.log("!" + $(this).html() + "!");
        if ($(this).html() == '<img src="../images/edit.png" width="20px">') {
            $(this).html('<img src="../images/save.png" width="20px">');
            $('#UserImInput, #UserFamInput, #UserOtInput, #UsernameInput, #UserPhoneinput').prop('disabled', false);
        }
        else { //сохранение изменений
            if ($('#UserImInput').val() == "" || $('#UserFamInput').val() == "" || $('#UserOtInput').val() == "" || $('#UsernameInput').val() == "" || $('#UserPhoneinput').val() == "") {
                alert('Недопустимое значение!');
            }
            else {
                var array = [];
                array.push($('#UserImInput').val());
                array.push($('#UserFamInput').val());
                array.push($('#UserOtInput').val());
                array.push($('#UsernameInput').val());
                array.push($('#UserPhoneinput').val());
                var rizz = JSON.stringify(array);
                $.ajax({
                    url: '/user/changeuser',
                    type: 'POST',
                    data: { rizz: rizz },
                    success: function (res) {
                        alert('Изменения сохранены!');
                    },
                    error: function (exeption) {
                        alert('Ошибка сохранения...');
                    }
                });


                $(this).html('<img src="../images/edit.png" width="20px">');
                $('#UserImInput, #UserFamInput, #UserOtInput, #UsernameInput, #UserPhoneinput').prop('disabled', true);
            }
        }
        return false;
    });

    $(document).on('click', '#confirmsearch', function () {
        var divss = document.querySelectorAll('div.roomsToReserv');

        divss.forEach(element => {
            $(element).removeClass('d-none');
        });
        if ($('#searchPlace').val() != "" || $('#searchIn').val() != "" || $('#searchOut').val() != "") {
            var array = [];
            array.push($('#searchPlace').val());
            array.push($('#searchIn').val());
            array.push($('#searchOut').val());
            var ewq = JSON.stringify(array);
            $.ajax({
                url: '/user/searchrooms',
                type: 'POST',
                data: { ewq: ewq },
                success: function (res) {
                    var mas = JSON.parse(res);
                    divss.forEach(element => {
                        if (mas.includes(Number($(element).attr('name')))) {
                            $(element).addClass('d-none');
                        }

                        var der = document.querySelectorAll('button.setReservation');
                        der.forEach(element => {
                            $(element).prop('disabled', false);
                        });
                    });
                },
                error: function (exeption) {
                    alert('Ошибка сохранения...');
                }
            });
        }
        return false;
    });

    $(document).on('click', 'button.setReservation', function () {
        var array = [];
        array.push($(this).attr('name')); // id apart
        array.push($('#searchIn').val());
        array.push($('#searchOut').val());
        console.log(array);
        var yui = JSON.stringify(array);
        $.ajax({
            url: '/user/reservation',
            type: 'POST',
            data: { yui: yui },
            success: function (res) {
                alert('Увидеть бронь вы можете в своем профиле!');
                location.reload();
            },
            error: function (exeption) {
                alert('Ошибка сохранения...');
            }
        });
    });
});