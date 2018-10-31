$(document).ready(function(){

    var $loading = $('#loading').hide();

    $(document)
        .ajaxStart(function () {
            $loading.show();
        })
        .ajaxStop(function () {
            $loading.hide();
        });

    var warnalembaga = document.getElementById('txbwarnalembaga').value;

    var txbcancelbookberhasil = document.getElementById('txbcancelbookberhasil').value;

    if(txbcancelbookberhasil != ''){

        swal({
            title: "Berhasil!",
            text: "Anda telah membatalkan satu transaksi hotel",
            type: "success",
            confirmButtonColor: warnalembaga
        });

        document.getElementById('txbcancelbookberhasil').value = '';
    }


    $('#tanggalkamarcheckin .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: 'd'
    });

    $('#tanggalkamarcheckout .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: '+1d'
    });

    $('#tanggalcheckin .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: 'd'
    });

    $('#tanggalcheckout .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: '+1d'
    });

    $('#modal-cari-hotel').on('shown.bs.modal', function () {

        document.getElementById('txbsearchkeyword').value = '';

        $('#txbsearchkeyword').focus();

        $("#searchList").find("tr:gt(0)").remove();

        document.getElementById('popularList').style.display = 'block';

    });

    $("#formcarihotel").validate({

    });

    $('.data-hotel').DataTable({
        responsive: true,
        sorting: false
    });

    //page booking hotel

    $("#formkontak").validate({

    });

    $("#formbayar").validate({

    });

    //input no telepon di page booking hotel
    var noteleponkontak = document.getElementById('noteleponkontak');
    var goodKey = '0123456789';

    var checkInputTel = function(e) {
        var key = (typeof e.which == "number") ? e.which : e.keyCode;
        var start = this.selectionStart,
            end = this.selectionEnd;

        var filtered = this.value.split('').filter(filterInput);
        this.value = filtered.join("");

        /* Prevents moving the pointer for a bad character */
        var move = (filterInput(String.fromCharCode(key)) || (key == 0 || key == 8)) ? 0 : 1;
        this.setSelectionRange(start - move, end - move);
    }

    var filterInput = function(val) {
        return (goodKey.indexOf(val) > -1);
    }

    noteleponkontak.addEventListener('input', checkInputTel);

});

function onclicktxbsearchotel(){
    $('#modal-cari-hotel').modal('show');
}

function searchcityhotel() {

    var keyword = document.getElementById('txbsearchkeyword').value;
    var page = document.getElementById('txbpage').value;

    if(page == 'hotel'){
        var url = 'hotel/caridestination?keyword='+keyword;
    }else{
        var url = 'caridestination?keyword='+keyword;
    }

    $.get(url, function(data){
        datax= JSON.parse(data);

        document.getElementById('popularList').style.display = 'none';

        $("#searchList").find("tr:gt(0)").remove();

        jumlahdata = datax['data'].length;

        if(jumlahdata > 0){

            for (i = 0; i < jumlahdata; i++) {
                var label = datax['data'][i]['label'];
                var group = datax['data'][i]['group'];
                var key = datax['data'][i]['key'];
                var label_location = datax['data'][i]['label_location'];

                if(group != 'Hotel'){

                    var icon = 'fa fa-map-marker';


                }else{

                    var icon = 'fa fa-hotel';
                }

                $('#searchList').append("<tr style='border-bottom: solid 1px;'>" +
                                            "<td>" +
                                                "<i class='"+icon+"'></i> " +
                                                "<button data-label='"+label+"'" +
                                                        "data-key ='"+key+"' " +
                                                        "data-group = '"+group+"' " +
                                                        "data-labellocation='"+label_location+"' " +
                                                        "onclick='pilihcityhotel(this)' style='background-color: transparent; border: none;'>"+label+"</button>" +
                                            "</td>" +
                                        "</tr>");

            }

        }else{

            $('#searchList').append("<tr style='border-bottom: solid 1px;'><td>MAAF, DATA TIDAK DITEMUKAN, CARI KOTA ATAU HOTEL DENGAN KEYWORD LAIN  !!</td></tr>");


        }

    });


}

function cleartext() {
    document.getElementById('txbsearchkeyword').value = '';
}

function pilihcityhotel(button) {
    var label = $(button).attr('data-label');
    var group = $(button).attr('data-group');
    var key = $(button).attr('data-key');
    var labellocation = $(button).attr('data-labellocation');

    var index = label.indexOf("(");

    var result = label.substr(0, index);

    var datalabel = result;

    if(group != 'Hotel'){


        var indexAlamat = label.indexOf(",");

        var alamat = label.substr(0, indexAlamat);


    }else{

        var indexAlamat = labellocation.indexOf(",");

        var alamat = labellocation.substr(0, indexAlamat);
    }

    alamat=alamat.split(' ').join('-');

    document.getElementById('txbnamakotahotel').value = datalabel;
    document.getElementById('txbgroup').value = group;
    document.getElementById('txbkey').value = key;
    document.getElementById('txbalamat').value = alamat;
    $('#modal-cari-hotel').modal('hide');

}

function ubahjmlmalam() {
    var jmlmalam = document.getElementById('jmlmalam').value;
    var tglcheckin = document.getElementById('tglcheckin').value;

    var split = tglcheckin.split('/');
    var spdate = split[0];
    var spmonth = split[1];
    var spyear = split[2];

    var newtglcheckin = spmonth+'/'+spdate+'/'+spyear;

    var date = new Date(newtglcheckin);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + parseInt(jmlmalam));

    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    if(dd < 10){
        dd = '0'+dd;
    }

    if(mm < 10){
        mm = '0'+mm;
    }

    var tglcheckout = dd + '/' + mm + '/' + y;

    var datepicker = $('#tglcheckout');
    datepicker.datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: '+1d'
    });
    datepicker.datepicker('setDate', tglcheckout);

    document.getElementById('tglcheckout').value = tglcheckout;
}

function ubahtglcheckout() {
    var tglcheckin = document.getElementById('tglcheckin').value;
    var tglcheckout = document.getElementById('tglcheckout').value;

    var splitin = tglcheckin.split('/');
    var spindate = splitin[0];
    var spinmonth = splitin[1];
    var spinyear = splitin[2];

    var datecheckin = spinmonth+'/'+spindate+'/'+spinyear;

    var splitout = tglcheckout.split('/');
    var spoutdate = splitout[0];
    var spoutmonth = splitout[1];
    var spoutyear = splitout[2];

    var datecheckout = spoutmonth+'/'+spoutdate+'/'+spoutyear;

    var date1 = new Date(datecheckin);
    var date2 = new Date(datecheckout);
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    document.getElementById('jmlmalam').value = diffDays;

}

function submitcarihotel() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var tglcheckin =document.getElementById('tglcheckin').value;
    var tglcheckout = document.getElementById('tglcheckout').value;

    var txbnamakotahotel = document.getElementById('txbnamakotahotel').value;

    var split = tglcheckin.split('/');
    var spdate = split[0];
    var spmonth = split[1];
    var spyear = split[2];

    var newtglcheckin = spmonth+'/'+spdate+'/'+spyear;

    var split = tglcheckout.split('/');
    var spdate = split[0];
    var spmonth = split[1];
    var spyear = split[2];

    var newtglcheckout = spmonth+'/'+spdate+'/'+spyear;

    var d1 = new Date(newtglcheckin);
    var d2 = new Date(newtglcheckout);

    var page = document.getElementById('txbpage').value;

    if(page == 'hotel'){
        var url = 'hotel/carihotel';
    }else{
        var url = 'carihotel';
    }

    if(txbnamakotahotel == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih kota atau hotel tujuan anda!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(d1 > d2){
        swal({
            title: "WARNING",
            text: "Tanggal checkin tidak boleh melebihi tanggal checkout!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{
        document.getElementById("formcarihotel").action = url;
        document.getElementById("formcarihotel").submit();
        document.getElementById("btncarihotel").value = "Sedang Mencari ...";

    }
}

//page v_hotelsearch

function showubahcari() {

    var formubahcari = document.getElementById('formubahcari');
    var btnubahcari = document.getElementById('btnubahcari');


    if (formubahcari.style.display !== 'block') {
        formubahcari.style.display = 'block';

    } else {
        formubahcari.style.display = 'none';
    }

}

function changesort() {
    document.getElementById('loadingsorting').style.display = 'block';

    document.getElementById("formsorting").submit();
}

//page v_hoteldetail

function submitcarihotelindetail() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var tglcheckin = document.getElementById('tglcheckin').value;
    var tglcheckout = document.getElementById('tglcheckout').value;
    var txbnamakotahotel = document.getElementById('txbnamakotahotel').value;

    var page = document.getElementById('txbpage').value;

    if(page == 'hotel'){
        var url = 'hotel/carihotel';
    }else{
        var url = 'carihotel';
    }

    if(txbnamakotahotel == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih kota atau hotel tujuan anda!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(tglcheckin > tglcheckout){
        swal({
            title: "WARNING",
            text: "Tanggal checkin tidak boleh melebihi tanggal checkout!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{
        document.getElementById("formcarihotel").action = url;
        document.getElementById("formcarihotel").submit();
        document.getElementById("btncarihotel").value = "Sedang Mencari ...";

    }
}

function ubahjmlkamarmalam() {
    var jmlmalam = document.getElementById('jmlkamarmalam').value;
    var tglcheckin = document.getElementById('tglkamarcheckin').value;

    var split = tglcheckin.split('/');
    var spdate = split[0];
    var spmonth = split[1];
    var spyear = split[2];

    var newtglcheckin = spmonth+'/'+spdate+'/'+spyear;

    var date = new Date(newtglcheckin);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + parseInt(jmlmalam));

    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    if(dd < 10){
        dd = '0'+dd;
    }

    if(mm < 10){
        mm = '0'+mm;
    }

    var tglcheckout = dd + '/' + mm + '/' + y;

    var datepicker = $('#tglkamarcheckout');
    datepicker.datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: '+1d'
    });
    datepicker.datepicker('setDate', tglcheckout);

    document.getElementById('tglkamarcheckout').value = tglcheckout;
}

function ubahkamartglcheckout() {
    var tglcheckin = document.getElementById('tglkamarcheckin').value;
    var tglcheckout = document.getElementById('tglkamarcheckout').value;

    var splitin = tglcheckin.split('/');
    var spindate = splitin[0];
    var spinmonth = splitin[1];
    var spinyear = splitin[2];

    var datecheckin = spinmonth+'/'+spindate+'/'+spinyear;

    var splitout = tglcheckout.split('/');
    var spoutdate = splitout[0];
    var spoutmonth = splitout[1];
    var spoutyear = splitout[2];

    var datecheckout = spoutmonth+'/'+spoutdate+'/'+spoutyear;

    var date1 = new Date(datecheckin);
    var date2 = new Date(datecheckout);
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    document.getElementById('jmlkamarmalam').value = diffDays;

}

function submitcarikamar() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var tglcheckin = document.getElementById('tglkamarcheckin').value;
    var tglcheckout = document.getElementById('tglkamarcheckout').value;
    

    if(tglcheckin > tglcheckout){
        swal({
            title: "WARNING",
            text: "Tanggal checkin tidak boleh melebihi tanggal checkout!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{
        document.getElementById("formcarikamar").action = 'detailhotel';
        document.getElementById("formcarikamar").submit();
        document.getElementById("btncarikamar").value = "Sedang Mencari ...";

    }
}

function changepaymentmethod() {
    var method = document.getElementById('slmethodpayment').value;

    if(method == 'Transfer'){
        document.getElementById('divtransfer').style.display = 'block';
        document.getElementById('namabank').value = '';
        document.getElementById('norekening').value = '';
        document.getElementById('namapengirim').value = '';
    }else{
        document.getElementById('divtransfer').style.display = 'none';
        document.getElementById('namabank').value = '-';
        document.getElementById('norekening').value = '-';
        document.getElementById('namapengirim').value = '-';
    }
}

function cancelbook() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;

    swal({
        title: "Anda Yakin?",
        text: "Anda akan membatalkan pemesanan hotel ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: warnalembaga,
        confirmButtonText: "Ya",
        closeOnConfirm: false
    }, function () {
        document.getElementById("formbayar").action = "cancelbook";
        document.getElementById("formbayar").submit();
    });
}

