$(document).ready(function(){

    $("#formpesantiket").validate({

    });

    $("#forminputdatapenumpang").validate({

    });

    $("#formcancelbooking").validate({

    });

    $.get('Kereta/getdatastation', function(data){

        if(data){
            document.getElementById("loading").style.display = "none";
            if(data.name == ''){
                document.getElementById("alertapistasiun").style.display = "block";
                document.getElementById("btnsubmit").disabled = true;
            }else{
                $(".st_from").typeahead({source:data.name});
                $(".st_to").typeahead({ source:data.name });
                document.getElementById("btnsubmit").disabled = false;
            }
        }

    },'json');

    $.get('getdatastation', function(data){
        $(".st_from_ubah").typeahead({source:data.name});

        $(".st_to_ubah").typeahead({ source:data.name });

    },'json');

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

    $('#tanggalpergiubah .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: 'd'
    });

    $('#tanggalpulangubah .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
        startDate: 'd'
    });

    $('#tgllahirdewasa .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('#tgllahirbayi .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    $('.i-checks-pergi').iCheck({
        radioClass: 'iradio_square-red',
    });

    $('.i-checks-pulang').iCheck({
        radioClass: 'iradio_square-red',
    });

    $('.i-checks-ubah').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    var tanggalpulang = document.getElementById("tanggalpulang");

    $('.cekpp').on('ifChecked', function(event){
        tanggalpulang.style.display = "block";
    });

    $('.cekpp').on('ifUnchecked', function(event){
        tanggalpulang.style.display = "none";
    });

    var tanggalpulangubah = document.getElementById("tanggalpulangubah");

    $('.cekppubah').on('ifChecked', function(event){
        tanggalpulangubah.style.display = "block";
    });

    $('.cekppubah').on('ifUnchecked', function(event){
        tanggalpulangubah.style.display = "none";
    });

    $('.datajadwalkereta').DataTable({
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        paging:   false,
        searching:   false,
        aaSorting: [ [1,'asc']],
        buttons: []

    });

    $('.datajadwalkeretapergi').DataTable({
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        paging:   false,
        searching:   false,
        aaSorting: [ [1,'asc']],
        buttons: []

    });

    $('.datajadwalkeretapulang').DataTable({
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        paging:   false,
        searching:   false,
        aaSorting: [ [1,'asc']],
        buttons: []

    });

    var totalharga = 0;

    $('.pilihpergi').on('ifChecked', function(event){
        document.getElementById("formsebelumpilihpergi").style.display= 'none';
        document.getElementById("formpilihpergi").style.display= 'block';

        var trainnumber = $(this).attr('data-trainnumber');
        var trainname = $(this).attr('data-trainname');
        var grade = $(this).attr('data-grade');
        var grd = $(this).attr('data-grd');
        var dataclass = $(this).attr('data-class');
        var departuretime = $(this).attr('data-departuretime');
        var arrivaltime = $(this).attr('data-arrivaltime');
        var harga = $(this).attr('data-harga');
        var tglpergi = $(this).attr('data-tglpergi');

        var jmldewasa = document.getElementById("jmldewasa").value;
        var jmlbayi = document.getElementById("jmlbayi").value;
        var trainhargapergi = document.getElementById("trainhargapergi").value;

        totalharga = totalharga - parseInt(trainhargapergi);

        document.getElementById("trainnamepergi").innerHTML= trainname +' (' + trainnumber + ')';
        document.getElementById("traingradepergi").innerHTML= grade +' (Subclass ' + dataclass + ')';
        document.getElementById("traindeparturetimepergi").innerHTML= departuretime;
        document.getElementById("trainarrivaltimepergi").innerHTML= arrivaltime;
        document.getElementById("trainhargapergi").value = harga;

        totalharga += parseInt(harga);
        var total = parseInt(totalharga)*parseInt(jmldewasa);
        document.getElementById("trainpptotalharga").innerHTML= toRp(total);

        document.getElementById("txbtrainnamepergi").value = trainname;
        document.getElementById("txbtrainnumberpergi").value = trainnumber;
        document.getElementById("txbtanggalpergi").value = tglpergi;
        document.getElementById("txbdeparturetimepergi").value = departuretime;
        document.getElementById("txbarrivaltimepergi").value = arrivaltime;
        document.getElementById("txbgradepergi").value = grd;
        document.getElementById("txbsubclasspergi").value = dataclass;
        document.getElementById("txbpriceadultpergi").value = harga;

    });


    $('.pilihpulang').on('ifChecked', function(event){
        document.getElementById("formsebelumpilihpulang").style.display= 'none';
        document.getElementById("formpilihpulang").style.display= 'block';

        var trainnumber = $(this).attr('data-trainnumber');
        var trainname = $(this).attr('data-trainname');
        var grade = $(this).attr('data-grade');
        var grd = $(this).attr('data-grd');
        var dataclass = $(this).attr('data-class');var departuretime = $(this).attr('data-departuretime');
        var arrivaltime = $(this).attr('data-arrivaltime');
        var harga = $(this).attr('data-harga');
        var tglpulang = $(this).attr('data-tglpulang');

        var jmldewasa = document.getElementById("jmldewasa").value;
        var jmlbayi = document.getElementById("jmlbayi").value;
        var trainhargapulang = document.getElementById("trainhargapulang").value;

        totalharga = totalharga - parseInt(trainhargapulang);


        document.getElementById("trainnamepulang").innerHTML= trainname +' (' + trainnumber + ')';
        document.getElementById("traingradepulang").innerHTML= grade +' (Subclass ' + dataclass + ')';
        document.getElementById("traindeparturetimepulang").innerHTML= departuretime;
        document.getElementById("trainarrivaltimepulang").innerHTML= arrivaltime;
        document.getElementById("trainhargapulang").value= harga;


        totalharga += parseInt(harga);
        var total = parseInt(totalharga)*parseInt(jmldewasa);
        document.getElementById("trainpptotalharga").innerHTML= toRp(total);

        document.getElementById("txbtrainnamepulang").value = trainname;
        document.getElementById("txbtrainnumberpulang").value = trainnumber;
        document.getElementById("txbtanggalpulang").value = tglpulang;
        document.getElementById("txbdeparturetimepulang").value = departuretime;
        document.getElementById("txbarrivaltimepulang").value = arrivaltime;
        document.getElementById("txbgradepulang").value = grd;
        document.getElementById("txbsubclasspulang").value = dataclass;
        document.getElementById("txbpriceadultpulang").value = harga;

    });


    //input no telepon
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

    //input no telepon dewasa

    var jumlahdewasa = document.getElementById("txbjmldewasa").value;

    for (i = 1; i <= jumlahdewasa; i++) {
        var notelpdewasa = 'notelepondewasa'+''+i;
        document.getElementById(notelpdewasa).addEventListener('input', checkInputTel);
    }

});

jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
    return ((x < y) ? -1 : ((x > y) ?  1 : 0));
};

jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
    return ((x < y) ?  1 : ((x > y) ? -1 : 0));
};

function clearstfrom() {
    document.getElementById("st_from").value = '';
}

function clearstto() {
    document.getElementById("st_to").value = '';
}

function clearstfromubah() {
    document.getElementById("st_from_ubah").value = '';
}

function clearsttoubah() {
    document.getElementById("st_to_ubah").value = '';
}

function tukar() {
    var stfrom = document.getElementById("st_from").value;
    var stto = document.getElementById("st_to").value;

    document.getElementById("st_from").value = stto;
    document.getElementById("st_to").value = stfrom;
}

function tukarubah() {
    var stfrom = document.getElementById("st_from_ubah").value;
    var stto = document.getElementById("st_to_ubah").value;

    document.getElementById("st_from_ubah").value = stto;
    document.getElementById("st_to_ubah").value = stfrom;
}

function showubahcari() {

    var formubahcari = document.getElementById('formubahcari');
    var btnubahcari = document.getElementById('btnubahcari');


    if (formubahcari.style.display !== 'block') {
        formubahcari.style.display = 'block';

    } else {
        formubahcari.style.display = 'none';
    }

}

function submitpergi(button){

    var warnalembaga = document.getElementById("txbwarnalembaga").value;
    var trname= $(button).attr('data-trname');
    var trnumber= $(button).attr('data-trnumber');
    var trgrade= $(button).attr('data-trgrade');
    var trclass= $(button).attr('data-trclass');
    var trdep= $(button).attr('data-trdep');
    var trarr= $(button).attr('data-trarr');
    var id= $(button).attr('data-id');

    var namaform = "formpilihpergi"+id;

    swal({
        title: "Anda Yakin?",
        text: "Anda akan memilih Kereta "+trname+"("+trnumber+") - "+trgrade+" (Subclass "+trclass+"), Jadwal Pemberangkatan "+trdep+" - "+trarr+"?",
        showCancelButton: true,
        confirmButtonColor: warnalembaga,
        confirmButtonText: "Ya",
        closeOnConfirm: false
    }, function () {
        document.getElementById(namaform).action = "viewinformasibooking";
        document.getElementById(namaform).submit();
    });

}

function submitpulangpergi() {
    var txbtrainnamepergi = document.getElementById("txbtrainnamepergi").value;
    var txbtrainnamepulang = document.getElementById("txbtrainnamepulang").value;
    var warnalembaga = document.getElementById("txbwarnalembaga").value;

    if(txbtrainnamepergi == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih jadwal kereta pergi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(txbtrainnamepulang == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih jadwal kereta pulang!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{
        swal({
            title: "Anda Yakin?",
            text: "Anda telah memilih jadwal yang benar?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formpilihpulangpergi").action = "viewinformasibooking";
            document.getElementById("formpilihpulangpergi").submit();
        });
    }

}

function submitpulangpergi() {
    var txbtrainnamepergi = document.getElementById("txbtrainnamepergi").value;
    var txbtrainnamepulang = document.getElementById("txbtrainnamepulang").value;
    var warnalembaga = document.getElementById("txbwarnalembaga").value;

    if(txbtrainnamepergi == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih jadwal kereta pergi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(txbtrainnamepulang == ''){
        swal({
            title: "WARNING",
            text: "MAAF anda belum memilih jadwal kereta pulang!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{
        swal({
            title: "Anda Yakin?",
            text: "Anda telah memilih jadwal yang benar?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formpilihpulangpergi").action = "viewinformasibooking";
            document.getElementById("formpilihpulangpergi").submit();
        });
    }

}

function pindahkursipergi(clicked_id) {
    var lastChar = clicked_id.substr(clicked_id.length - 1);
    var formlayout = 'formlayoutkeretapergi'+lastChar;
    var formlayoutkereta = document.getElementById(formlayout);
    formlayoutkereta.style.display = "block";
}

function tutuplayoutpergi(clicked_id) {
    var lastChar = clicked_id.substr(clicked_id.length - 1);
    var formlayout = 'formlayoutkeretapergi'+lastChar;
    var formlayoutkereta = document.getElementById(formlayout);
    formlayoutkereta.style.display = "none";
}

function pilihlayoutgerbongpergi(button) {
    var nopenumpang = $(button).attr('data-nopenumpang');
    var wagoncode = $(button).attr('data-wagoncode');
    var wagonnumber = $(button).attr('data-wagonnumber');
    var jumlahwagon = $(button).attr('data-jumlahwagon');

    var tds = $('#tabeldatawagonpergi').children('tbody').children('tr').children('td').length;

    var idname = 'DWPERGI'+''+nopenumpang+''+wagoncode+''+wagonnumber;

    for (i = 1; i <= tds; i++) {
        var kodewagon = 'DWPERGI'+''+nopenumpang+''+wagoncode+''+i;
        var nameofid = document.getElementById(kodewagon).id;

        if(nameofid == idname) {
            document.getElementById(nameofid).style.display = 'block';
        }else{
            document.getElementById(nameofid).style.display = 'none';
        }
    }

}

function pindahkursipulang(clicked_id) {
    var lastChar = clicked_id.substr(clicked_id.length - 1);
    var formlayout = 'formlayoutkeretapulang'+lastChar;
    var formlayoutkereta = document.getElementById(formlayout);
    formlayoutkereta.style.display = "block";
}

function tutuplayoutpulang(clicked_id) {
    var lastChar = clicked_id.substr(clicked_id.length - 1);
    var formlayout = 'formlayoutkeretapulang'+lastChar;
    var formlayoutkereta = document.getElementById(formlayout);
    formlayoutkereta.style.display = "none";
}

function pilihlayoutgerbongpulang(button) {
    var nopenumpang = $(button).attr('data-nopenumpang');
    var wagoncode = $(button).attr('data-wagoncode');
    var wagonnumber = $(button).attr('data-wagonnumber');
    var jumlahwagon = $(button).attr('data-jumlahwagon');

    var tds = $('#tabeldatawagonpulang').children('tbody').children('tr').children('td').length;

    var idname = 'DWPULANG'+''+nopenumpang+''+wagoncode+''+wagonnumber;

    for (i = 1; i <= tds; i++) {
        var kodewagon = 'DWPULANG'+''+nopenumpang+''+wagoncode+''+i;
        var nameofid = document.getElementById(kodewagon).id;

        if(nameofid == idname) {
            document.getElementById(nameofid).style.display = 'block';
        }else{
            document.getElementById(nameofid).style.display = 'none';
        }
    }

}

function kursipergiyangdipilih(button) {

    var wagoncode = $(button).attr('data-wagoncode');
    var wagonnumber = $(button).attr('data-wagonnumber');
    var wagonrow = $(button).attr('data-wagonrow');
    var wagoncolumn = $(button).attr('data-wagoncolumn');
    var nopenumpang = $(button).attr('data-nopenumpang');

    var noseatpenumpang = wagoncode+'-'+wagonnumber+', '+wagonrow+''+wagoncolumn;

    var idtxbnoseatbarupenumpang = 'txbnoseatbarupenumpangpergi'+''+nopenumpang;
    var idtxbwagonnumberpenumpang = 'txbwagonnumberpenumpangpergi'+''+nopenumpang;
    var idtxbrowpenumpang = 'txbrowpenumpangpergi'+''+nopenumpang;
    var idtxbcolumnpenumpang = 'txbcolumnpenumpangpergi'+''+nopenumpang;

    var idthisbutton = 'btn'+nopenumpang+''+wagoncode+''+wagonnumber+''+wagonrow+''+wagoncolumn;


    alert('Anda akan pindah tempat duduk ke : '+noseatpenumpang);

    document.getElementById(idtxbnoseatbarupenumpang).value = noseatpenumpang;
    document.getElementById(idtxbwagonnumberpenumpang).value = wagonnumber;
    document.getElementById(idtxbrowpenumpang).value = wagonrow;
    document.getElementById(idtxbcolumnpenumpang).value = wagoncolumn;

    var formlayout = 'formlayoutkeretapergi'+nopenumpang;
    var formlayoutkereta = document.getElementById(formlayout);
    formlayoutkereta.style.display = "none";

    var btnhapuskursipergi = 'btnhapuskursipergi'+''+nopenumpang;
    document.getElementById(btnhapuskursipergi).style.display = 'block';


}

function hapuskursipergi(button) {

    var wagonnumber = $(button).attr('data-wagonnumber');
    var wagonrow = $(button).attr('data-wagonrow');
    var wagoncolumn = $(button).attr('data-wagoncolumn');
    var nopenumpang = $(button).attr('data-nopenumpang');

    var idtxbnoseatbarupenumpang = 'txbnoseatbarupenumpangpergi'+''+nopenumpang;
    var idtxbwagonnumberpenumpang = 'txbwagonnumberpenumpangpergi'+''+nopenumpang;
    var idtxbrowpenumpang = 'txbrowpenumpangpergi'+''+nopenumpang;
    var idtxbcolumnpenumpang = 'txbcolumnpenumpangpergi'+''+nopenumpang;

    document.getElementById(idtxbnoseatbarupenumpang).value = '-';
    document.getElementById(idtxbwagonnumberpenumpang).value = wagonnumber;
    document.getElementById(idtxbrowpenumpang).value = wagonrow;
    document.getElementById(idtxbcolumnpenumpang).value = wagoncolumn;

    var btnhapuskursipergi = 'btnhapuskursipergi'+''+nopenumpang;
    document.getElementById(btnhapuskursipergi).style.display = 'none';
}

function kursipulangyangdipilih(button) {

    var wagoncode = $(button).attr('data-wagoncode');
    var wagonnumber = $(button).attr('data-wagonnumber');
    var wagonrow = $(button).attr('data-wagonrow');
    var wagoncolumn = $(button).attr('data-wagoncolumn');
    var nopenumpang = $(button).attr('data-nopenumpang');

    var noseatpenumpang = wagoncode+'-'+wagonnumber+', '+wagonrow+''+wagoncolumn;

    var idtxbnoseatbarupenumpang = 'txbnoseatbarupenumpangpulang'+''+nopenumpang;
    var idtxbwagonnumberpenumpang = 'txbwagonnumberpenumpangpulang'+''+nopenumpang;
    var idtxbrowpenumpang = 'txbrowpenumpangpulang'+''+nopenumpang;
    var idtxbcolumnpenumpang = 'txbcolumnpenumpangpulang'+''+nopenumpang;

    var idthisbutton = 'btn'+nopenumpang+''+wagoncode+''+wagonnumber+''+wagonrow+''+wagoncolumn;


    alert('Anda akan pindah tempat duduk ke : '+noseatpenumpang);

    document.getElementById(idtxbnoseatbarupenumpang).value = noseatpenumpang;
    document.getElementById(idtxbwagonnumberpenumpang).value = wagonnumber;
    document.getElementById(idtxbrowpenumpang).value = wagonrow;
    document.getElementById(idtxbcolumnpenumpang).value = wagoncolumn;

    var formlayout = 'formlayoutkeretapulang'+nopenumpang;
    var formlayoutkereta = document.getElementById(formlayout);
    formlayoutkereta.style.display = "none";

    var btnhapuskursipergi = 'btnhapuskursipulang'+''+nopenumpang;
    document.getElementById(btnhapuskursipergi).style.display = 'block';

}

function hapuskursipulang(button) {

    var wagonnumber = $(button).attr('data-wagonnumber');
    var wagonrow = $(button).attr('data-wagonrow');
    var wagoncolumn = $(button).attr('data-wagoncolumn');
    var nopenumpang = $(button).attr('data-nopenumpang');

    var idtxbnoseatbarupenumpang = 'txbnoseatbarupenumpangpulang'+''+nopenumpang;
    var idtxbwagonnumberpenumpang = 'txbwagonnumberpenumpangpulang'+''+nopenumpang;
    var idtxbrowpenumpang = 'txbrowpenumpangpulang'+''+nopenumpang;
    var idtxbcolumnpenumpang = 'txbcolumnpenumpangpulang'+''+nopenumpang;

    document.getElementById(idtxbnoseatbarupenumpang).value = '-';
    document.getElementById(idtxbwagonnumberpenumpang).value = wagonnumber;
    document.getElementById(idtxbrowpenumpang).value = wagonrow;
    document.getElementById(idtxbcolumnpenumpang).value = wagoncolumn;

    var btnhapuskursipergi = 'btnhapuskursipulang'+''+nopenumpang;
    document.getElementById(btnhapuskursipergi).style.display = 'none';

}

function submitfixduduk() {

    var warnalembaga = document.getElementById("txbwarnalembaga").value;

    var jmldewasa = document.getElementById("txbjmldewasa").value;

    var txbtanggalpulang = document.getElementById("txbtanggalpulang").value;

    var arrtxbwagonnumberpergi = [];

    for (i = 1; i <= jmldewasa; i++) {

        var idtxbwagonnumberpenumpangpergi = 'txbwagonnumberpenumpangpergi'+''+i;
        var valtxbwagonnumberpenumpangpergi = document.getElementById(idtxbwagonnumberpenumpangpergi).value;

        arrtxbwagonnumberpergi.push(valtxbwagonnumberpenumpangpergi);

    }

    var cekarrtxbwagonnumberpergi = arrtxbwagonnumberpergi.allValuesSame();

    if(txbtanggalpulang==''){

        if(cekarrtxbwagonnumberpergi == false){
            swal({
                title: "WARNING",
                text: "Tempat duduk tiap penumpang di perjalanan pergi tidak diperbolehkan berbeda gerbong kereta !",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else{
            swal({
                title: "Anda Yakin?",
                text: "Anda telah memilih tempat duduk yang benar?",
                showCancelButton: true,
                confirmButtonColor: warnalembaga,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            }, function () {
                document.getElementById("formpilihkursi").action = "viewpembayaran";
                document.getElementById("formpilihkursi").submit();
            });
        }

    }else {

        var arrtxbwagonnumberpulang = [];

        for (i = 1; i <= jmldewasa; i++) {

            var idtxbwagonnumberpenumpangpulang = 'txbwagonnumberpenumpangpulang'+''+i;
            var valtxbwagonnumberpenumpangpulang = document.getElementById(idtxbwagonnumberpenumpangpulang).value;

            arrtxbwagonnumberpulang.push(valtxbwagonnumberpenumpangpulang);

        }

        var cekarrtxbwagonnumberpulang = arrtxbwagonnumberpulang.allValuesSame();

        if (cekarrtxbwagonnumberpergi == false) {
            swal({
                title: "WARNING",
                text: "Tempat duduk tiap penumpang di perjalanan pergi tidak diperbolehkan berbeda gerbong kereta !",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        } else if (cekarrtxbwagonnumberpulang == false) {
            swal({
                title: "WARNING",
                text: "Tempat duduk tiap penumpang di perjalanan pulang tidak diperbolehkan berbeda gerbong kereta !",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        } else {
            swal({
                title: "Anda Yakin?",
                text: "Anda telah memilih tempat duduk yang benar?",
                showCancelButton: true,
                confirmButtonColor: warnalembaga,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            }, function () {
                document.getElementById("formpilihkursi").action = "viewpembayaran";
                document.getElementById("formpilihkursi").submit();
            });
        }
    }


}

Array.prototype.allValuesSame = function() {

    for(var i = 1; i < this.length; i++)
    {
        if(this[i] !== this[0])
            return false;
    }

    return true;
}

function submittranskereta() {
    var warnalembaga = document.getElementById("txbwarnalembaga").value;

    var saldo = document.getElementById("txbsaldosekarang").value;
    var nominal = document.getElementById('txbtotalharga').value;

    if(parseInt(saldo) < parseInt(nominal)){

        swal({
            title: "WARNING",
            text: "Maaf, saldo anda tidak mencukupi !",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else{

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan pemesanan tiket kereta ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formtranskereta").action = "simpantransaksi";
            document.getElementById("formtranskereta").submit();
        });

    }
}

