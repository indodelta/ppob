$(document).ready(function(){

    $.get('penerbangan/getdataairport', function(data){

        document.getElementById("btnsubmit").disabled = true;

        if(data){
            document.getElementById("loading").style.display = "none";
            if(data.name == ''){

                document.getElementById("errorapiairport").style.display = "block";
                document.getElementById("btnsubmit").disabled = true;

            }else{

                $(".air_from").typeahead({
                    source:data.name
                });

                $(".air_to").typeahead({
                    source:data.name
                });

                document.getElementById("btnsubmit").disabled = false;
            }
        }else{
            document.getElementById("loading").style.display = "none";
            document.getElementById("errorapiairport").style.display = "block";
            document.getElementById("btnsubmit").disabled = true;

        }

    },'json');

    //ichecks return
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
        startDate: 'd'
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

    // Bind submit buttons
    Ladda.bind( '.ladda-button');

    $("#formpesantiket").validate({

    });

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
