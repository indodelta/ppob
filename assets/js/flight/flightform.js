$(document).ready(function () {

    // Tooltips demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });

    //ichecks jadwal pergi
    $('.i-checks-pergi').iCheck({
        radioClass: 'iradio_square-red',
    });

    //ichecks jadwal pergi
    $('.i-checks-pulang').iCheck({
        radioClass: 'iradio_square-red',
    });

    //pilih pergi
    var totalharga = 0;

    $('.pilihpergi').on('ifChecked', function(event){
        document.getElementById("formsebelumpilihpergi").style.display= 'none';
        document.getElementById("formpilihpergi").style.display= 'block';

        var airlineicon = $(this).attr('data-airlineicon');
        var transit = $(this).attr('data-transit');
        var flightcode = $(this).attr('data-flightcode');
        var jampergi = $(this).attr('data-jampergi');
        var jamtiba = $(this).attr('data-jamtiba');
        var harga = $(this).attr('data-harga');
        var detailtransit = $(this).attr('data-detailtransit');
        var flighthargapergi = document.getElementById("flighthargapergi").value;

        var jumlahpesawatpergi = $(this).attr('data-jumlahpesawatpergi');
        var jumlahclassespergi = $(this).attr('data-jumlahclassespergi');
        var istransitpergi = $(this).attr('data-istransitpergi');
        var airlinecodepergi = $(this).attr('data-airlinecodepergi');

        $('#inputpilihpergi').remove();

        var div = document.createElement("DIV");
        div.setAttribute("id", "inputpilihpergi");
        $('#rowinputpilihpergi').append(div);

        totalharga = totalharga - parseInt(flighthargapergi);

        document.getElementById("flighthargapergi").value = harga;

        document.getElementById("iconpilihpergi").src = airlineicon;
        document.getElementById("transitpilihpergi").innerHTML= transit;
        document.getElementById("flightcodepilihpergi").innerHTML= flightcode;
        if(transit!='Langsung'){
            document.getElementById("detailtransitpilihpergi").innerHTML= detailtransit;
        }else{
            document.getElementById("detailtransitpilihpergi").innerHTML= '';
        }
        document.getElementById("jampergipilihpergi").innerHTML= jampergi;
        document.getElementById("jamtibapilihpergi").innerHTML= jamtiba;

        totalharga += parseInt(harga);
        document.getElementById("flighttotalhargapp").innerHTML= toRp(totalharga);

        document.getElementById("txbjumlahpesawatpergi").value= jumlahpesawatpergi;
        document.getElementById("txbjumlahclassespergi").value= jumlahclassespergi;
        document.getElementById("txbistransitpergi").value= istransitpergi;
        document.getElementById("txbairlinecodepergi").value= airlinecodepergi;
        document.getElementById("txbjampergipergi").value= jampergi;
        document.getElementById("txbjamtibapergi").value= jamtiba;

        for (i = 0; i < jumlahpesawatpergi; i++) {
            var flightcodepergi = $(this).attr('data-flightcodepergi'+i);
            var transittimepergi = $(this).attr('data-transittimepergi'+i);
            var flighticonpergi = $(this).attr('data-flighticonpergi'+i);
            var flightnamepergi = $(this).attr('data-flightnamepergi'+i);
            var flightclasspergi = $(this).attr('data-flightclasspergi'+i);
            var seatspergi = $(this).attr('data-seatspergi'+i);
            var departtimepergi = $(this).attr('data-departtimepergi'+i);
            var transitname1pergi = $(this).attr('data-transitname1pergi'+i);
            var arrivaltimepergi = $(this).attr('data-arrivaltimepergi'+i);
            var transitname2pergi = $(this).attr('data-transitname2pergi'+i);

            var a = document.createElement("INPUT");a.setAttribute("type", "hidden");
            a.setAttribute("value", flightcodepergi);a.setAttribute("id", "txbflightcodepergi"+i);
            a.setAttribute("name", "flightcodepergi"+i);$('#inputpilihpergi').append(a);

            var b = document.createElement("INPUT");b.setAttribute("type", "hidden");
            b.setAttribute("value", transittimepergi);b.setAttribute("id", "txbtransittimepergi"+i);
            b.setAttribute("name", "transittimepergi"+i);$('#inputpilihpergi').append(b);

            var c = document.createElement("INPUT");c.setAttribute("type", "hidden");
            c.setAttribute("value", flighticonpergi);c.setAttribute("id", "txbflighticonpergi"+i);
            c.setAttribute("name", "flighticonpergi"+i);$('#inputpilihpergi').append(c);

            var d = document.createElement("INPUT");d.setAttribute("type", "hidden");
            d.setAttribute("value", flightnamepergi);d.setAttribute("id", "txbflightnamepergi"+i);
            d.setAttribute("name", "flightnamepergi"+i);$('#inputpilihpergi').append(d);

            var e = document.createElement("INPUT");e.setAttribute("type", "hidden");
            e.setAttribute("value", flightclasspergi);e.setAttribute("id", "txbflightclasspergi"+i);
            e.setAttribute("name", "flightclasspergi"+i);$('#inputpilihpergi').append(e);

            var f = document.createElement("INPUT");f.setAttribute("type", "hidden");
            f.setAttribute("value", seatspergi);f.setAttribute("id", "txbseatspergi"+i);
            f.setAttribute("name", "seatspergi"+i);$('#inputpilihpergi').append(f);

            var g = document.createElement("INPUT");g.setAttribute("type", "hidden");
            g.setAttribute("value", departtimepergi);g.setAttribute("id", "txbdeparttimepergi"+i);
            g.setAttribute("name", "departtimepergi"+i);$('#inputpilihpergi').append(g);

            var h = document.createElement("INPUT");h.setAttribute("type", "hidden");
            h.setAttribute("value", transitname1pergi);h.setAttribute("id", "txbtransitname1pergi"+i);
            h.setAttribute("name", "transitname1pergi"+i);$('#inputpilihpergi').append(h);

            var k = document.createElement("INPUT");k.setAttribute("type", "hidden");
            k.setAttribute("value", arrivaltimepergi);k.setAttribute("id", "txbarrivaltimepergi"+i);
            k.setAttribute("name", "arrivaltimepergi"+i); $('#inputpilihpergi').append(k);

            var j = document.createElement("INPUT");j.setAttribute("type", "hidden");
            j.setAttribute("value", transitname2pergi);j.setAttribute("id", "txbtransitname2pergi"+i);
            j.setAttribute("name", "transitname2pergi"+i);$('#inputpilihpergi').append(j);

        }

    });

    //pilih pulang

    $('.pilihpulang').on('ifChecked', function(event){
        document.getElementById("formsebelumpilihpulang").style.display= 'none';
        document.getElementById("formpilihpulang").style.display= 'block';

        var airlineicon = $(this).attr('data-airlineicon');
        var transit = $(this).attr('data-transit');
        var flightcode = $(this).attr('data-flightcode');
        var jampergi = $(this).attr('data-jampergi');
        var jamtiba = $(this).attr('data-jamtiba');
        var harga = $(this).attr('data-harga');
        var detailtransit = $(this).attr('data-detailtransit');
        var flighthargapulang = document.getElementById("flighthargapulang").value;

        var jumlahpesawatpulang = $(this).attr('data-jumlahpesawatpulang');
        var jumlahclassespulang = $(this).attr('data-jumlahclassespulang');
        var istransitpulang = $(this).attr('data-istransitpulang');
        var airlinecodepulang = $(this).attr('data-airlinecodepulang');

        $('#inputpilihpulang').remove();

        var div = document.createElement("DIV");
        div.setAttribute("id", "inputpilihpulang");
        $('#rowinputpilihpulang').append(div);

        totalharga = totalharga - parseInt(flighthargapulang);

        document.getElementById("flighthargapulang").value = harga;

        document.getElementById("iconpilihpulang").src = airlineicon;
        document.getElementById("transitpilihpulang").innerHTML= transit;
        document.getElementById("flightcodepilihpulang").innerHTML= flightcode;
        if(transit!='Langsung'){
            document.getElementById("detailtransitpilihpulang").innerHTML= detailtransit;
        }else{
            document.getElementById("detailtransitpilihpulang").innerHTML= '';
        }
        document.getElementById("jampergipilihpulang").innerHTML= jampergi;
        document.getElementById("jamtibapilihpulang").innerHTML= jamtiba;

        totalharga += parseInt(harga);
        document.getElementById("flighttotalhargapp").innerHTML= toRp(totalharga);

        document.getElementById("txbjumlahpesawatpulang").value= jumlahpesawatpulang;
        document.getElementById("txbjumlahclassespulang").value= jumlahclassespulang;
        document.getElementById("txbistransitpulang").value= istransitpulang;
        document.getElementById("txbairlinecodepulang").value= airlinecodepulang;
        document.getElementById("txbjampergipulang").value= jampergi;
        document.getElementById("txbjamtibapulang").value= jamtiba;

        for (i = 0; i < jumlahpesawatpulang; i++) {
            var flightcodepulang = $(this).attr('data-flightcodepulang'+i);
            var transittimepulang = $(this).attr('data-transittimepulang'+i);
            var flighticonpulang = $(this).attr('data-flighticonpulang'+i);
            var flightnamepulang = $(this).attr('data-flightnamepulang'+i);
            var flightclasspulang = $(this).attr('data-flightclasspulang'+i);
            var seatspulang = $(this).attr('data-seatspulang'+i);
            var departtimepulang = $(this).attr('data-departtimepulang'+i);
            var transitname1pulang = $(this).attr('data-transitname1pulang'+i);
            var arrivaltimepulang = $(this).attr('data-arrivaltimepulang'+i);
            var transitname2pulang = $(this).attr('data-transitname2pulang'+i);

            var a = document.createElement("INPUT");a.setAttribute("type", "hidden");
            a.setAttribute("value", flightcodepulang);a.setAttribute("id", "txbflightcodepulang"+i);
            a.setAttribute("name", "flightcodepulang"+i);$('#inputpilihpulang').append(a);

            var b = document.createElement("INPUT");b.setAttribute("type", "hidden");
            b.setAttribute("value", transittimepulang);b.setAttribute("id", "txbtransittimepulang"+i);
            b.setAttribute("name", "transittimepulang"+i);$('#inputpilihpulang').append(b);

            var c = document.createElement("INPUT");c.setAttribute("type", "hidden");
            c.setAttribute("value", flighticonpulang);c.setAttribute("id", "txbflighticonpulang"+i);
            c.setAttribute("name", "flighticonpulang"+i);$('#inputpilihpulang').append(c);

            var d = document.createElement("INPUT");d.setAttribute("type", "hidden");
            d.setAttribute("value", flightnamepulang);d.setAttribute("id", "txbflightnamepulang"+i);
            d.setAttribute("name", "flightnamepulang"+i);$('#inputpilihpulang').append(d);

            var e = document.createElement("INPUT");e.setAttribute("type", "hidden");
            e.setAttribute("value", flightclasspulang);e.setAttribute("id", "txbflightclasspulang"+i);
            e.setAttribute("name", "flightclasspulang"+i);$('#inputpilihpulang').append(e);

            var f = document.createElement("INPUT");f.setAttribute("type", "hidden");
            f.setAttribute("value", seatspulang);f.setAttribute("id", "txbseatspulang"+i);
            f.setAttribute("name", "seatspulang"+i);$('#inputpilihpulang').append(f);

            var g = document.createElement("INPUT");g.setAttribute("type", "hidden");
            g.setAttribute("value", departtimepulang);g.setAttribute("id", "txbdeparttimepulang"+i);
            g.setAttribute("name", "departtimepulang"+i);$('#inputpilihpulang').append(g);

            var h = document.createElement("INPUT");h.setAttribute("type", "hidden");
            h.setAttribute("value", transitname1pulang);h.setAttribute("id", "txbtransitname1pulang"+i);
            h.setAttribute("name", "transitname1pulang"+i);$('#inputpilihpulang').append(h);

            var k = document.createElement("INPUT");k.setAttribute("type", "hidden");
            k.setAttribute("value", arrivaltimepulang);k.setAttribute("id", "txbarrivaltimepulang"+i);
            k.setAttribute("name", "arrivaltimepulang"+i);$('#inputpilihpulang').append(k);

            var j = document.createElement("INPUT");j.setAttribute("type", "hidden");
            j.setAttribute("value", transitname2pulang);j.setAttribute("id", "txbtransitname2pulang"+i);
            j.setAttribute("name", "transitname2pulang"+i);$('#inputpilihpulang').append(j);

        }

    });


});

function submitpergi(button) {

    var warnalembaga = document.getElementById("txbwarnalembaga").value;
    var noairline= $(button).attr('data-noairline');
    var nojadwal= $(button).attr('data-nojadwal');
    var airname= $(button).attr('data-airlinename');

    var namaform = 'formpilihpergi'+noairline+''+nojadwal;

    nojadwal = parseInt(nojadwal) + 1;

    swal({
        title: "Anda Yakin?",
        text: "Anda akan memilih Rute Penerbangan "+airname+" No."+nojadwal,
        showCancelButton: true,
        confirmButtonColor: warnalembaga,
        confirmButtonText: "Ya",
        closeOnConfirm: true
    }, function () {
        document.getElementById(namaform).action = "info";
        document.getElementById(namaform).submit();
    });

}

function submitpulangpergi(button) {

    var txbjumlahpesawatpergi = document.getElementById("txbjumlahpesawatpergi").value;
    var txbjumlahpesawatpulang = document.getElementById("txbjumlahpesawatpulang").value;
    var warnalembaga = document.getElementById("txbwarnalembaga").value;

    if(txbjumlahpesawatpergi == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih jadwal pesawat pergi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(txbjumlahpesawatpulang == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih jadwal pesawat pulang!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{
        swal({
            title: "Anda Yakin?",
            text: "Anda telah memilih Rute Penerbangan dengan benar ",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: true
        }, function () {
            document.getElementById('formpilihpulangpergi').action = "info";
            document.getElementById('formpilihpulangpergi').submit();
        });
    }

}