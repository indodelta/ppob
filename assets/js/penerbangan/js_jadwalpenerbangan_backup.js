$(document).ready(function(){

    $.get('getdataairport', function(data){

        if(data){
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

            }
        }else{
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

    $("#formpesantiket").validate({});

    tampildata();

});

function tampildata(){

    // data jadwal

    $('#loading').show();

    var warnalembaga = document.getElementById("txbwarnalembaga").value;
    var cekreturn = document.getElementById("cekpp").value;
    var jumlahairline = document.getElementById("jumlahairline").value;
    var air_from = document.getElementById("air_from").value;
    var air_to = document.getElementById("air_to").value;
    var tgl_pergi = document.getElementById("tgl_pergi").value;
    var tgl_pulang = document.getElementById("tgl_pulang").value;
    var adult = document.getElementById("adult").value;
    var child = document.getElementById("child").value;
    var infant = document.getElementById("infant").value;
    var hasilsorting = document.getElementById("hasilsorting").value;

    var jumlahdatajadwal = 0;

    for (var i = 0; i < jumlahairline; i++) {

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
                tglpulang: tgl_pergi,
                jml_adult: adult,
                jml_child: child,
                jml_infant: infant,
            },
            async : false,
            success: function (ajaxData){
                if (ajaxData) {
                    var datapergi = JSON.parse(ajaxData);

                    console.log(datapergi);

                    var rc = datapergi[0].rc;

                    if(rc == 00){

                        var data = datapergi[0].data;
                        var jumlahpesawat = Object.keys(data).length;

                        if(hasilsorting == 1){

                            // for (var x = 0; x < jumlahpesawat; x++) {
                            //
                            //     var detailTitle = datapergi[0].data[x].detailTitle;
                            //     var jumlahdetailtitle = Object.keys(detailTitle).length;
                            //     var classes = datapergi[0].data[x].classes;
                            //     var jumlahclasses = Object.keys(classes).length;
                            //     var totalprice = 0;
                            //     for (var p = 0; p < jumlahclasses; p++) {
                            //         var price = datapergi[0].data[x].classes[p][0].price;
                            //         totalprice += parseInt(price);
                            //     }
                            //
                            // }

                        }

                        jumlahdatajadwal += 1;

                        for (var x = 0; x < jumlahpesawat; x++) {

                            var airlineName = datapergi[0].data[x].airlineName;
                            var airlineIcon = datapergi[0].data[x].airlineIcon;
                            var airlineCode = datapergi[0].data[x].airlineCode;
                            var detailTitle = datapergi[0].data[x].detailTitle;
                            var jumlahdetailtitle = Object.keys(detailTitle).length;
                            var isTransit = datapergi[0].data[x].isTransit;
                            var duration = datapergi[0].data[x].duration;
                            var depart = datapergi[0].data[x].detailTitle[0].depart;
                            var arrival = datapergi[0].data[x].detailTitle[0].arrival;
                            var origin = datapergi[0].data[x].detailTitle[0].origin;
                            var destination = datapergi[0].data[x].detailTitle[0].destination;
                            var textistransit = 'LANGSUNG';

                            if(isTransit == true){
                                var lastindexdetailtitle = jumlahdetailtitle - 1;
                                arrival = datapergi[0].data[x].detailTitle[lastindexdetailtitle].arrival;
                                destination = datapergi[0].data[x].detailTitle[lastindexdetailtitle].destination;
                                var textistransit = jumlahdetailtitle - 1 +' TRANSIT';
                            }
                            var timedepartarrival = '('+origin+') '+depart+' - ('+destination+') '+arrival;
                            var classes = datapergi[0].data[x].classes;
                            var jumlahclasses = Object.keys(classes).length;
                            var totalprice = 0;
                            for (var p = 0; p < jumlahclasses; p++) {
                                var price = datapergi[0].data[x].classes[p][0].price;
                                totalprice += parseInt(price);
                            }

                            var idibox = 'ibox'+airlineCode+x;

                            var hr = '';
                            if(x == jumlahpesawat - 1){
                                hr = '<hr style="border: solid 1px '+warnalembaga+'"/>';
                            }


                            var divdetailtilte = '<table class="table no-borders" style="font-size: 12px;">';

                            for(var dt = 0; dt < jumlahdetailtitle; dt++){

                                var origin = datapergi[0].data[x].detailTitle[dt].origin;
                                var originname = datapergi[0].data[x].detailTitle[dt].originName;
                                var destination = datapergi[0].data[x].detailTitle[dt].destination;
                                var destinationname = datapergi[0].data[x].detailTitle[dt].destinationName;
                                var dtflighticon = datapergi[0].data[x].detailTitle[dt].flightIcon;
                                var dtdeparturedate = datapergi[0].data[x].detailTitle[dt].departureDate;
                                var dtdurationdetail = datapergi[0].data[x].detailTitle[dt].durationDetail;
                                var dtflightname = datapergi[0].data[x].detailTitle[dt].flightName;
                                var dtflightcode = datapergi[0].data[x].detailTitle[dt].flightCode;
                                var dtdepart = datapergi[0].data[x].detailTitle[dt].depart;
                                var dtarrival = datapergi[0].data[x].detailTitle[dt].arrival;
                                var transitName1 = originname+' ('+origin+')';
                                var transitName2 = destinationname+' ('+destination+')';
                                var clavailability = datapergi[0].data[x].classes[dt][0].availability;
                                var dttransittime = datapergi[0].data[x].detailTitle[dt].transitTime;

                                if(dttransittime != '0j0m'){
                                    dttransittime = dttransittime.replace('m', ' Menit ');
                                    dttransittime = dttransittime.replace('j', ' Jam ');
                                    var txbtransit = 'Transit di '+transitName1+' selama '+dttransittime;
                                    divdetailtilte = divdetailtilte +
                                        '<tr style="background-color: #F4F4F5; padding: 0px;">' +
                                        '<td colspan="5" style="vertical-align: middle; padding: 0px;">' +
                                        '<input type="text"' +
                                        '       value="'+txbtransit+'" ' +
                                        '       style="text-align: center; width: 100%; font-size: 14px; border: none; background-color: white; color: black;' +
                                        '       readonly">' +
                                        '</td>' +
                                        '</tr>';
                                }

                                divdetailtilte = divdetailtilte +
                                    '<tr> ' +
                                    '<td style="vertical-align: middle;">'+ origin+' > '+destination+'<br/>' +
                                    '<b>'+dateindo(dtdeparturedate)+'</b><br/>' +
                                    dtdurationdetail +
                                    '</td>' +
                                    '<td style="vertical-align: middle;">' +
                                    '<img class="img-sm" src="'+dtflighticon+'" style="width: 50px;"><br/>' +
                                    dtflightname+'<br/>' +
                                    dtflightcode +
                                    '</td>' +
                                    '<td style="vertical-align: middle;">'+
                                    '<text style="font-size: 18px; font-weight: bold;">'+dtdepart+'</text><br/>' +
                                    transitName1 +
                                    '</td>' +
                                    '<td style="vertical-align: middle;">'+
                                    '<text style="font-size: 18px; font-weight: bold;">'+dtarrival+'</text><br/>' +
                                    transitName2 +
                                    '</td>' +
                                    '<td style="vertical-align: middle;"> Sisa Kursi = '+clavailability+'</td>' +
                                    '</tr>';
                            }

                            divdetailtilte = divdetailtilte + '</table>';

                            $('#divjadwal').append("<div class='ibox-content' style='padding: 15px; margin-top: 20px;'>" +
                                "<div class='row'>" +
                                "<div class='col-sm-1'>" +
                                "<img class='img-sm' src='"+airlineIcon+"' style='width: 50px;'>"+
                                "</div> "+
                                "<div class='col-sm-4'>" +
                                "<text style='font-size: 14px;'>"+airlineName+"</text><br/>" +
                                "<text style='font-size: 16px;'><b>"+timedepartarrival+"</b></text>"+
                                "</div> "+
                                "<div class='col-sm-3'>" +
                                "<text style='font-size: 16px;'><b>"+duration+"</b></text><br/>" +
                                "<text style='font-size: 12px;'>"+textistransit+"</text>" +
                                "</div> "+
                                "<div class='col-sm-3 text-center'>" +
                                "<text style='font-size: 16px;'><b>"+toRp(totalprice)+"</b></text><br/>" +
                                "<button class='btn btn-danger'>Pesan Sekarang</button>" +
                                "</div> "+
                                "<div class='col-sm-1 text-right'>" +
                                "<div class='ibox-tools'>" +
                                "<a data-toggle='collapse' data-target='#"+idibox+"' class='collapse-link'>" +
                                "<i class='fa fa-chevron-down fa-2x'></i>" +
                                "</a>" +
                                "</div> " +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "<div class='ibox-content collapse' style='margin-bottom: 10px; padding-top: 10px; padding-bottom: 10px;' id="+idibox+">" +
                                divdetailtilte +
                                "</div>"+
                                hr
                            )


                        }
                    }
                }

            }
        });

        if(i == jumlahairline - 1){
            $('#loading').hide();

            if(sort != 0){
                document.getElementById("loadingsorting").style.display = "none";
            }
        }

        console.log(jumlahdatajadwal);

    }

    if(jumlahdatajadwal == 0){
        document.getElementById("iboxdatatidakditemukan").style.display = "block";
    }else{
        document.getElementById("textharga0").style.display = "block";
        document.getElementById("selectsorting").style.display = "block";
    }

}

function changesort() {
    var sorting = document.getElementById("sorting").value;

    if(sorting != 0){
        document.getElementById("formsorting").submit();
    }

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
