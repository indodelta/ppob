$(document).ready(function(){

    $.get('get_origin', function(data){$(".origin").typeahead({source:data.name});},'json');
    $.get('get_destination', function(data){$(".destination").typeahead({source:data.name});},'json');

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

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });
    var tanggalpulang = document.getElementById("tanggalpulang");

    $('.cekpp').on('ifChecked', function(event){
        tanggalpulang.style.display = "block";
    });
    $('.cekpp').on('ifUnchecked', function(event){
        tanggalpulang.style.display = "none";
    });

    $("#formpesantiket").validate({});


});

function showhargakelas(select) {
    var value = select.options[select.selectedIndex].value;

    var splitvalue = value.split("/");
    var nokelas = splitvalue[0];
    var namakelas = splitvalue[1];
    var jmlfare = splitvalue[2];
    var nofare = splitvalue[3];

    var namaspan = 'span'+nokelas;
    document.getElementById(namaspan).innerHTML = namakelas;

    var tableshow = 'table'+nokelas+nofare;

    for (i = 0; i < jmlfare; i++) {
        var idtable = 'table'+nokelas+i;

        if(idtable == tableshow){
            document.getElementById(tableshow).style.display = 'block';
        }else{
            document.getElementById(idtable).style.display = 'none';
        }

    }

}

function showhargakelaspergi(select) {
    var value = select.options[select.selectedIndex].value;

    var splitvalue = value.split("/");
    var nokelas = splitvalue[0];
    var namakelas = splitvalue[1];
    var jmlfare = splitvalue[2];
    var nofare = splitvalue[3];

    var namaspan = 'spanpergi'+nokelas;
    document.getElementById(namaspan).innerHTML = namakelas;

    var tableshow = 'tablepergi'+nokelas+nofare;

    for (i = 0; i < jmlfare; i++) {
        var idtable = 'tablepergi'+nokelas+i;

        if(idtable == tableshow){
            document.getElementById(tableshow).style.display = 'block';
        }else{
            document.getElementById(idtable).style.display = 'none';
        }

    }


    var btnkelaspergi = 'btnkelaspergi'+nokelas+nofare;
    for (i = 0; i < jmlfare; i++) {
        var idbtn = 'btnkelaspergi'+nokelas+i;

        if(idbtn == btnkelaspergi){
            document.getElementById(btnkelaspergi).style.display = 'block';
        }else{
            document.getElementById(idbtn).style.display = 'none';
        }

    }

}

function showhargakelaspulang(select) {
    var value = select.options[select.selectedIndex].value;

    var splitvalue = value.split("/");
    var nokelas = splitvalue[0];
    var namakelas = splitvalue[1];
    var jmlfare = splitvalue[2];
    var nofare = splitvalue[3];

    var namaspan = 'spanpulang'+nokelas;
    document.getElementById(namaspan).innerHTML = namakelas;

    var tableshow = 'tablepulang'+nokelas+nofare;

    for (i = 0; i < jmlfare; i++) {
        var idtable = 'tablepulang'+nokelas+i;

        if(idtable == tableshow){
            document.getElementById(tableshow).style.display = 'block';
        }else{
            document.getElementById(idtable).style.display = 'none';
        }

    }

    var btnkelaspulang = 'btnkelaspulang'+nokelas+nofare;
    for (i = 0; i < jmlfare; i++) {
        var idbtn = 'btnkelaspulang'+nokelas+i;

        if(idbtn == btnkelaspulang){
            document.getElementById(btnkelaspulang).style.display = 'block';
        }else{
            document.getElementById(idbtn).style.display = 'none';
        }

    }

}

function clearori() {
    document.getElementById("origin").value = '';
}

function cleardest() {
    document.getElementById("destination").value = '';
}

function showubahcari() {

    var formubahcari = document.getElementById('formubahcari');

    if (formubahcari.style.display !== 'block') {
        formubahcari.style.display = 'block';
    } else {
        formubahcari.style.display = 'none';
    }

}

function tukar() {
    var ori = document.getElementById("origin").value;
    var des = document.getElementById("destination").value;

    document.getElementById("destination").value = ori;
    document.getElementById("origin").value = des;
}

function ubahtglpergi() {
    var tglpergi = document.getElementById('dppergi').value;
    document.getElementById('dppulang').value = tglpergi;

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

function submittiket() {
    var warnalembaga = document.getElementById("txbwarnalembaga").value;
    var origin = document.getElementById("origin").value;
    var dest = document.getElementById("destination").value;
    var jmlpria = parseInt(document.getElementById("jmlpria").value);
    var jmlwanita = parseInt(document.getElementById("jmlwanita").value);
    var jmlbayi = parseInt(document.getElementById("jmlbayi").value);
    var dppergi = document.getElementById("dppergi").value;
    var dppulang = document.getElementById("dppulang").value;

    var splitorigin = origin.split(' ');
    var splitdest = dest.split(' ');
    var splitdppergi = dppergi.split('/');
    var tanggalpergi = splitdppergi[2]+'-'+splitdppergi[1]+'-'+splitdppergi[0]
    var tglpergi = new Date(tanggalpergi);
    var splitdppulang = dppulang.split('/');
    var tanggalpulang = splitdppulang[2]+'-'+splitdppulang[1]+'-'+splitdppulang[0];
    var tglpulang = new Date(tanggalpulang);

    if(origin != '' && dest != '' && dppergi != '' && dppulang != ''){
        document.getElementById('btnsubmit').type = "button";

        if(splitorigin[1] != '-'){

            swal({
                title: "WARNING",
                text: "Format Tempat asal salah, silahkan ikuti format yang tersedia!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });

        }else{

            if(splitdest[1] != '-'){

                swal({
                    title: "WARNING",
                    text: "Format Tempat tujuan salah, silahkan ikuti format yang tersedia!",
                    type: "warning",
                    confirmButtonColor: warnalembaga
                });

            }else{

                if(tglpergi > tglpulang){

                    swal({
                        title: "WARNING",
                        text: "Tanggal pergi tidak boleh melebihi tanggal pulang!",
                        type: "warning",
                        confirmButtonColor: warnalembaga
                    });

                }else{

                    if(jmlpria == 0 && jmlwanita == 0){
                        swal({
                            title: "WARNING",
                            text: "Anda belum menambahkan jumlah penumpang, dengan maksimal 10 pembelian tiket!",
                            type: "warning",
                            confirmButtonColor: warnalembaga
                        });
                    }else {

                        if (jmlpria + jmlwanita + jmlbayi > 10) {
                            swal({
                                title: "WARNING",
                                text: "Maaf, maks pembelian 10 Tiket!",
                                type: "warning",
                                confirmButtonColor: warnalembaga
                            });
                        } else {
                            document.getElementById('btnsubmit').type = "submit";
                            document.getElementById('formpesantiket').action = "jadwal";
                        }

                    }

                }

            }

        }
    }

}

function pilihtabpergi() {
    var tabpergi = document.getElementById("tabpergi");
    var tabpulang = document.getElementById("tabpulang");
    var judultabpergi = document.getElementById("judultabpergi");
    var judultabpulang = document.getElementById("judultabpulang");
    tabpergi.style.display = "block";
    tabpulang.style.display = "none";
    judultabpergi.classList.add("aktif");
    judultabpulang.classList.remove("aktif");
}

function pilihtabpulang() {
    var tabpergi = document.getElementById("tabpergi");
    var tabpulang = document.getElementById("tabpulang");
    var judultabpergi = document.getElementById("judultabpergi");
    var judultabpulang = document.getElementById("judultabpulang");
    tabpulang.style.display = "block";
    tabpergi.style.display = "none";
    judultabpergi.classList.remove("aktif");
    judultabpulang.classList.add("aktif");

}

var totalharga = 0;

function pilihkelaspergi(button) {
    document.getElementById("formpilihpergi").style.display = "block";
    document.getElementById("formsebelumpilihpergi").style.display = "none";

    var jmlpria = parseInt(document.getElementById("jmlpria").value);
    var jmlwanita = parseInt(document.getElementById("jmlwanita").value);
    var jmlbayi = parseInt(document.getElementById("jmlbayi").value);

    var shipsubtotalpergi = document.getElementById("shipsubtotalpergi").value;

    totalharga = totalharga - parseInt(shipsubtotalpergi);

    var shipnamepergi = $(button).attr('data-shipnamepergi');
    var shipnopergi = $(button).attr('data-shipnopergi');
    var shipsubkelaspergi = $(button).attr('data-shipsubkelaspergi');
    var shipkelaspergi = $(button).attr('data-shipkelaspergi');
    var shipdepdatepergi = $(button).attr('data-shipdepdatepergi');
    var daydep = getDayName(shipdepdatepergi, "id-ID");
    var shipdeptimepergi = $(button).attr('data-shipdeptimepergi');
    var shiparvdatepergi = $(button).attr('data-shiparvpergi');
    var dayarv = getDayName(shiparvdatepergi, "id-ID");
    var shiparvtimepergi = $(button).attr('data-shiparvtimepergi');
    var shipadultpricepergi = $(button).attr('data-shipadultpricepergi');
    var shipinfantpricepergi = $(button).attr('data-shipinfantpricepergi');

    var subtotalpricepergi = (jmlpria*shipadultpricepergi)+(jmlwanita*shipadultpricepergi)+(jmlbayi*shipinfantpricepergi);

    document.getElementById("shipnamepergi").innerHTML= shipnopergi +' / ' + shipnamepergi;
    document.getElementById("shipclasspergi").innerHTML= shipkelaspergi +' - ' + shipsubkelaspergi;
    document.getElementById("shipdatedeppergi").innerHTML= daydep +', ' + dateindowithslash(shipdepdatepergi);
    document.getElementById("shiptimedeppergi").innerHTML= shipdeptimepergi;
    document.getElementById("shipdatearvpergi").innerHTML= dayarv +', ' + dateindowithslash(shiparvdatepergi);
    document.getElementById("shiptimearvpergi").innerHTML= shiparvtimepergi;

    document.getElementById("shipsubtotalpergi").value = subtotalpricepergi;

    totalharga += parseInt(subtotalpricepergi);

    document.getElementById("shiptotalhargapp").innerHTML= toRp(totalharga);

}

function pilihkelaspulang(button) {
    document.getElementById("formpilihpulang").style.display = "block";
    document.getElementById("formsebelumpilihpulang").style.display = "none";

    var jmlpria = parseInt(document.getElementById("jmlpria").value);
    var jmlwanita = parseInt(document.getElementById("jmlwanita").value);
    var jmlbayi = parseInt(document.getElementById("jmlbayi").value);

    var shipsubtotalpulang = document.getElementById("shipsubtotalpulang").value;

    totalharga = totalharga - parseInt(shipsubtotalpulang);

    var shipnamepulang = $(button).attr('data-shipnamepulang');
    var shipnopulang = $(button).attr('data-shipnopulang');
    var shipsubkelaspulang = $(button).attr('data-shipsubkelaspulang');
    var shipkelaspulang = $(button).attr('data-shipkelaspulang');
    var shipdepdatepulang = $(button).attr('data-shipdepdatepulang');
    var daydep = getDayName(shipdepdatepulang, "id-ID");
    var shipdeptimepulang = $(button).attr('data-shipdeptimepulang');
    var shiparvdatepulang = $(button).attr('data-shiparvpulang');
    var dayarv = getDayName(shiparvdatepulang, "id-ID");
    var shiparvtimepulang = $(button).attr('data-shiparvtimepulang');
    var shipadultpricepulang = $(button).attr('data-shipadultpricepulang');
    var shipinfantpricepulang = $(button).attr('data-shipinfantpricepulang');

    var subtotalpricepulang = (jmlpria*shipadultpricepulang)+(jmlwanita*shipadultpricepulang)+(jmlbayi*shipinfantpricepulang);

    document.getElementById("shipnamepulang").innerHTML= shipnopulang +' / ' + shipnamepulang;
    document.getElementById("shipclasspulang").innerHTML= shipkelaspulang +' - ' + shipsubkelaspulang;
    document.getElementById("shipdatedeppulang").innerHTML= daydep +', ' + dateindowithslash(shipdepdatepulang);
    document.getElementById("shiptimedeppulang").innerHTML= shipdeptimepulang;
    document.getElementById("shipdatearvpulang").innerHTML= dayarv +', ' + dateindowithslash(shiparvdatepulang);
    document.getElementById("shiptimearvpulang").innerHTML= shiparvtimepulang;

    document.getElementById("shipsubtotalpulang").value = subtotalpricepulang;

    totalharga += parseInt(subtotalpricepulang);

    document.getElementById("shiptotalhargapp").innerHTML= toRp(totalharga);

}

function submitkapal(button) {
    var warnalembaga = document.getElementById("txbwarnalembaga").value;
    var idform= $(button).attr('data-idform');

    var nokelas= $(button).attr('data-nokelas');
    var idselect = 'kelas'+nokelas;

    var e = document.getElementById(idselect);
    var value = e.options[e.selectedIndex].value;

    var splitvalue = value.split("/");
    var namakelas = splitvalue[1];
    var nokapal = splitvalue[4];
    var namakapal = splitvalue[5];
    var avaf = splitvalue[6];
    var avam = splitvalue[7];

    var jmlpria = parseInt(document.getElementById("jmlpria").value);
    var jmlwanita = parseInt(document.getElementById("jmlwanita").value);

    if(jmlpria > 0 && avaf == 0 && jmlwanita > 0 && avam == 0){

        swal({
            title: "WARNING",
            text: "Maaf, Kursi pada kelas dan kapal yang dipilih tidak tersedia!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(jmlpria > 0 && avaf == 0){

        swal({
            title: "WARNING",
            text: "Maaf, Kursi untuk pria pada kelas dan kapal yang dipilih tidak tersedia!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(jmlwanita > 0 && avam == 0){

        swal({
            title: "WARNING",
            text: "Maaf, Kursi untuk wanita pada kelas dan kapal yang dipilih tidak tersedia!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else{

        swal({
            title: "Anda Yakin?",
            text: "Anda akan memilih Kapal "+nokapal+" - "+namakapal+" Kelas "+namakelas+"?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: true
        }, function () {
            document.getElementById(idform).action = "penumpang";
            document.getElementById(idform).submit();
        });

    }

}