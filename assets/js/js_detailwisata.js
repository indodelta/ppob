$(document).ready(function() {

    var color = document.getElementById("txbcolor").value;
    var arraytanggal = document.getElementById("txbarraytanggal").value;
    var splittanggal= arraytanggal.split(',');
    var arrayratehotel = document.getElementById("txbarrayratehotel").value;
    var splitratehotel= arrayratehotel.split(',');
    var arrayquota = document.getElementById("txbarrayquota").value;
    var splitquota= arrayquota.split(',');
    var jumlahprices = document.getElementById("txbjumlahprices").value;

    $('#calendar').fullCalendar({
        lang: 'id',
        defaultView: 'month',
        contentHeight: 350,
        aspectRatio: 2,
        handleWindowResize: true,
        selectable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: '',
        },
        select: function(start, end) {

            if(jumlahprices>0){

                var pilihan = 0;

                var dstart = start.format('YYYY-MM-DD');

                for(var i = 0; i < jumlahprices; i++) {
                    var tanggal = splittanggal[i];

                    if(dstart == tanggal){
                        pilihan = pilihan + 1;
                        var key = i;
                    }

                }

                if(pilihan == 0){
                    swal({
                        title: "WARNING",
                        text: "Tidak bisa memilih di tanggal ini!",
                        type: "warning",
                        confirmButtonColor: color
                    });
                }else{

                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('rerenderEvents')
                    var title = "Tanggal Dipilih";
                    var eventData;
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true);

                    var tanggalpilih = start.format();
                    document.getElementById("txbpilihtanggal").value = tanggalpilih;
                    document.getElementById("txbpilihantanggal").value = dateindowithyear(tanggalpilih);

                    var ratehotel = splitratehotel[key];
                    document.getElementById("txbratehotel").value = ratehotel;
                    var quota = splitquota[key];
                    if(quota < 0){quota = ''}
                    document.getElementById("txbquota").value = quota;

                }

            }else{

                var today = new Date();

                if(start < today){

                    swal({
                        title: "WARNING",
                        text: "Tidak bisa memilih di tanggal ini!",
                        type: "warning",
                        confirmButtonColor: color
                    });

                }else{

                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('rerenderEvents')
                    var title = "Tanggal Dipilih";
                    var eventData;
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true);

                    var tanggalpilih = start.format();
                    document.getElementById("txbpilihtanggal").value = tanggalpilih;
                    document.getElementById("txbpilihantanggal").value = dateindowithyear(tanggalpilih);

                }

            }

        }

    });

});

function ubahjumlahpeserta() {
    var color = document.getElementById("txbcolor").value;
    var jumlahpeserta = document.getElementById("txbjumlahpeserta").value;

    var min = document.getElementById("txbpaxlistawal").value;
    var max = document.getElementById("txbpaxlistakhir").value;

    if(parseInt(jumlahpeserta) > parseInt(max)){

        swal({
            title: "WARNING",
            text: "Jumlah peserta tidak boleh lebih dari max jumlah peserta yang ditetapkan!",
            type: "warning",
            confirmButtonColor: color
        });

    }else if(parseInt(jumlahpeserta) < parseInt(min)){

        swal({
            title: "WARNING",
            text: "Jumlah peserta tidak boleh kurang dari min jumlah peserta yang ditetapkan!",
            type: "warning",
            confirmButtonColor: color
        });

    }else{

        var arrayjmlpesertalistprices = document.getElementById("txbarrayjmlpesertalistprices").value;
        var splitjmlpesertalistprices= arrayjmlpesertalistprices.split(',');
        var arrayhargalistprices = document.getElementById("txbarrayhargalistprices").value;
        var splithargalistprices= arrayhargalistprices.split(',');
        var jumlahlistprices = document.getElementById("txbjumlahlistprices").value;

        var key = '';
        var truekey = '';

        for(var i = 0; i < jumlahlistprices; i++) {
            var jmlpesertalistprices = splitjmlpesertalistprices[i];

            key = i;

            //cek kalau sama misal 1 dan 10
            var jmlpeserta = splitjmlpesertalistprices[key];

            if(jmlpeserta.includes('-')==true){

                var splitjmlpeserta= jmlpesertalistprices.split('-');
                var jmlpesertaawal = splitjmlpeserta[0];
                var jmlpesertaakhir = splitjmlpeserta[1];

                if (parseInt(jmlpesertaawal) <= jumlahpeserta && jumlahpeserta <= parseInt(jmlpesertaakhir)) {
                    truekey = key;
                }

            }else{

                if(jumlahpeserta == jmlpeserta){
                    truekey = key;
                }

            }

        }

        var hargaperpax = splithargalistprices[truekey];

        var totalharga = hargaperpax * jumlahpeserta;

        document.getElementById("txbtotalharga").value = totalharga;
        document.getElementById("txbtotalhargarupiah").value = toRp(totalharga);

    }


}

function submitform() {
    var color = document.getElementById("txbcolor").value;
    var pilihtanggal = document.getElementById("txbpilihtanggal").value;
    var jumlahpeserta = document.getElementById("txbjumlahpeserta").value;
    var min = document.getElementById("txbpaxlistawal").value;
    var max = document.getElementById("txbpaxlistakhir").value;

    if(pilihtanggal == ''){

        swal({
            title: "WARNING",
            text: "Anda belum menentukan tanggal pilihan liburan anda!",
            type: "warning",
            confirmButtonColor: color
        });

    }else if(parseInt(jumlahpeserta) > parseInt(max)){

        swal({
            title: "WARNING",
            text: "Jumlah peserta tidak boleh lebih dari max jumlah peserta yang ditetapkan!",
            type: "warning",
            confirmButtonColor: color
        });

    }else if(parseInt(jumlahpeserta) < parseInt(min)){

        swal({
            title: "WARNING",
            text: "Jumlah peserta tidak boleh kurang dari min jumlah peserta yang ditetapkan!",
            type: "warning",
            confirmButtonColor: color
        });

    }else{

        document.getElementById("formpesanan").action = "peserta";
        document.getElementById("formpesanan").submit();

    }
    
}