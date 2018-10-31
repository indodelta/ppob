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

    // Bind normal buttons
    Ladda.bind( '.ladda-button');

    //ichecks airline
     $('.i-checks-airline').iCheck({
         checkboxClass: 'icheckbox_square-red',
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

    var arrairline = [];

    for (i = 0; i < jumlahairline; i++) {
        var idtxbairline = 'airline'+i;

        var airline = document.getElementById(idtxbairline).value;

        arrairline.push(airline)

    }

    $.ajax({
        url: "getflightschedule",
        type: "POST",
        data : {cekreturn: cekreturn,
            airline: arrairline,
            air_from: air_from,
            air_to: air_to,
            tglpergi: tgl_pergi,
            tglpulang: tgl_pulang,
            jml_adult: adult,
            jml_child: child,
            jml_infant: infant,
        },
        success: function (ajaxData){
            var data = JSON.parse(ajaxData);

            var dictstring = JSON.stringify(ajaxData);

            $.ajax({
                url: "open_form_jadwal",
                type: "POST",
                data : {jadwal: data,
                        cekreturn: cekreturn,
                        airline: arrairline,
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
                }
            });

            console.log(data);
        }
    });

});

function closeWin() {

    window.close();

}

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