$(document).ready(function(){

    var $loading = $('#loading').hide();

    $(document)
        .ajaxStart(function () {
            $loading.show();
        })
        .ajaxStop(function () {
            $loading.hide();
        });

    $.get('getdataairport', function(data){
        $(".air_from").typeahead({
            source:data.name
        });

        $(".air_to").typeahead({
            source:data.name
        });

    },'json');


    $('.i-checks-pesawat').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    $('#tanggalpergi .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: 'd'
    });

    $('#tanggalpulang .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: 'd',
    });

    var dpenable = document.getElementById("tanggalpulang");
    var dpdisable = document.getElementById("tanggalpulangdisable");

    $('.cekreturn').on('ifChecked', function(event){
        dpenable.style.display = "block";
        dpdisable.style.display = "none";

        var tangpergi = document.getElementById('dppergi').value;
        document.getElementById('dppulangenable').value == tangpergi;
    });

    $('.cekreturn').on('ifUnchecked', function(event){
        dpenable.style.display = "none";
        dpdisable.style.display = "block";
    });

    $("#formpesantiket").validate({

    });

    // Bind submit buttons
    Ladda.bind( '.ladda-button');

    //ichecks airline
    $('.i-checks-airline').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    //ichecks all airline
    $('.i-checks-all-airline').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    $('.checkallairline').on('ifChecked', function(event){
        $('.airline').iCheck('check');
        triggeredByChild = false;
    });

    $('.checkallairline').on('ifUnchecked', function(event){
        if (!triggeredByChild) {
            $('.airline').iCheck('uncheck');
        }
        triggeredByChild = false;
    });

    $('.airline').on('ifUnchecked', function (event) {
        triggeredByChild = true;
        $('.checkallairline').iCheck('uncheck');
    });

    $('.airline').on('ifChecked', function (event) {
        if ($('.airline').filter(':checked').length == $('.check').length) {
            $('.checkallairline').iCheck('check');
        };

    });

    var cekreturn = document.getElementById("cekpp").value;
    var jumlahairline = document.getElementById("jumlahairline").value;
    var air_from = document.getElementById("air_from").value;
    var air_to = document.getElementById("air_to").value;
    var tgl_pergi = document.getElementById("tgl_pergi").value;
    var tgl_pulang = document.getElementById("tgl_pulang").value;
    var adult = document.getElementById("adult").value;
    var child = document.getElementById("child").value;
    var infant = document.getElementById("infant").value;

    var arrdata = [];

    if(cekreturn == 'on'){

        var arraypergi = [];
        var arraypulang = [];

        for (i = 0; i < jumlahairline; i++) {

            var idtxbairline = 'airline'+i;

            var airline = document.getElementById(idtxbairline).value;

            //ajax pergi

            $.ajax({
                url: "getflightschedule",
                type: "POST",
                data : {cekreturn: cekreturn,
                    airline: airline,
                    air_from: air_from,
                    air_to: air_to,
                    tglpergi: tgl_pergi,
                    tglpulang: tgl_pergi,
                    jml_adult: adult,
                    jml_child: child,
                    jml_infant: infant,
                },
                async: false,
                success: function (ajaxData){
                    if (ajaxData) {
                        var datapergi = JSON.parse(ajaxData);
                        arraypergi[i] = datapergi;
                    }else{
                        arraypergi[i] = [''];
                    }
                }
            });

            arrdata[0] = arraypergi;

            //ajax pulang

            $.ajax({
                url: "getflightschedule",
                type: "POST",
                data : {cekreturn: cekreturn,
                    airline: airline,
                    air_from: air_to,
                    air_to: air_from,
                    tglpergi: tgl_pulang,
                    tglpulang: tgl_pulang,
                    jml_adult: adult,
                    jml_child: child,
                    jml_infant: infant,
                },
                async: false,
                success: function (ajaxData){
                    if (ajaxData) {
                        var datapulang = JSON.parse(ajaxData);
                        arraypulang[i] = datapulang;
                    }else{
                        arraypulang[i] = [''];
                    }
                }
            });

            arrdata[1] = arraypulang;

        }

    }else{

        for (i = 0; i < jumlahairline; i++) {

            var idform = '#formJadwalPergi'+i;

            var idtxbairline = 'airline'+i;

            var airline = document.getElementById(idtxbairline).value;

            $.ajax({
                url: "getflightschedule",
                type: "POST",
                data : {cekreturn: cekreturn,
                    airline: airline,
                    air_from: air_from,
                    air_to: air_to,
                    tglpergi: tgl_pergi,
                    tglpulang: tgl_pulang,
                    jml_adult: adult,
                    jml_child: child,
                    jml_infant: infant,
                },
                async: false,
                success: function (ajaxData){
                    if (ajaxData) {
                        var data = JSON.parse(ajaxData);

                        arrdata[i] = data;
                    }else{
                        arrdata[i] = [''];
                    }
                }
            });

        }

    }

    $.ajax({
        url: "open_form_jadwal",
        type: "POST",
        data : {jadwal: arrdata,
            cekreturn: cekreturn,
            air_from: air_from,
            air_to: air_to,
            tglpergi: tgl_pergi,
            tglpulang: tgl_pulang,
            jml_adult: adult,
            jml_child: child,
            jml_infant: infant,
        },
        success: function (datapergi) {
            $("#formJadwalPergi").html(datapergi);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });

    console.log(arrdata);

});

function clearairfrom() {
    document.getElementById("air_from").value = '';
}

function clearairto() {
    document.getElementById("air_to").value = '';
}

function tukar_airport() {
    var airfrom = document.getElementById("air_from").value;
    var airto = document.getElementById("air_to").value;

    document.getElementById("air_from").value = airto;
    document.getElementById("air_to").value = airfrom;
}

function ubahtglpergi() {
    var tglpergi = document.getElementById('dppergi').value;
    document.getElementById('dppulangenable').value = tglpergi;
    document.getElementById('dppulangdisable').value = tglpergi;

    var datepicker = $('#tanggalpulang .input-group.date');
    datepicker.datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: '+1d'
    });
    datepicker.datepicker('setDate', tglpergi);
}

function showubahcari() {

    var formubahcari = document.getElementById('formubahcari');

    if (formubahcari.style.display !== 'block') {
        formubahcari.style.display = 'block';
    } else {
        formubahcari.style.display = 'none';
    }

}