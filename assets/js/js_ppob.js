$(document).ready(function(){

    var warnalembaga = document.getElementById("warnalembaga").value;
    var saldosekarang = document.getElementById("saldosekarang").value;

    var txbtambahdataberhasil = document.getElementById('txbtambahdataberhasil').value;

    if(txbtambahdataberhasil != ''){

        swal({
            title: "Berhasil!",
            text: "Anda telah melakukan satu transaksi",
            type: "success"
        });

        document.getElementById('txbtambahdataberhasil').value = '';
    }

    $.ajax({
        url: "Pascabayar/open_form_pascabayar",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formPascabayar").html(ajaxData);
        }
    });

    $.ajax({
        url: "PLN/open_form_pln",
        type: "GET",
        data : {warnalembaga: warnalembaga, datasaldo: saldosekarang,},
        success: function (ajaxData){
            $("#formPLN").html(ajaxData);
        }
    });

    $.ajax({
        url: "TELKOM/open_form_telkom",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formTELKOM").html(ajaxData);
        }
    });

    $.ajax({
        url: "PDAM/open_form_pdam",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formPDAM").html(ajaxData);
        }
    });

    $.ajax({
        url: "TVKabel/open_form_tvkabel",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formTVKabel").html(ajaxData);
        }
    });

    $.ajax({
        url: "GameOnline/open_form_gameonline",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formGameOnline").html(ajaxData);
        }
    });

    $.ajax({
        url: "Kredit/open_form_angskredit",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formAngsKredit").html(ajaxData);
        }
    });

    $.ajax({
        url: "EMoney/open_form_emoney",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formEMoney").html(ajaxData);
        }
    });

    $.ajax({
        url: "PGN/open_form_pgn",
        type: "GET",
        data : {warnalembaga: warnalembaga,},
        success: function (ajaxData){
            $("#formPGN").html(ajaxData);
        }
    });

});

function pilihkartukredit() {

    var divicontabakhir = document.getElementById('iconTabakhir');
    var litabakhir = document.getElementById('liTabakhir');
    var divtabakhir = document.getElementById('tab-9');
    var classicontabakhir = divicontabakhir.className;

    $(divicontabakhir).removeClass(classicontabakhir);

    var spans = $('#textTabakhir');

    var newclassname = "fa fa-cc fa-3x";
    var newtextname = "Kartu Kredit";
    $(divicontabakhir).addClass(newclassname);

    for (i = 1; i <= 8; i++) {
        var nameliid = 'liTab'+i;
        var liTab = document.getElementById(nameliid);

        var divid = 'tab-'+i;
        var divTab = document.getElementById(divid);

        $(liTab).removeClass("active");
        $(divTab).removeClass("active");
    }

    $(litabakhir).addClass("active");
    $(divtabakhir).addClass("active");

    spans.text(newtextname);

    $('.h3Tabakhir').text("Tagihan Kartu Kredit");
    $('#modal-lainnya').modal('hide');

    document.getElementById('formKartuKredit').style.display = 'block';
    document.getElementById('formZakat').style.display = 'none';
    document.getElementById('formEMoney').style.display = 'none';


}

function pilihzakat() {

    var divicontabakhir = document.getElementById('iconTabakhir');
    var litabakhir = document.getElementById('liTabakhir');
    var divtabakhir = document.getElementById('tab-9');
    var classicontabakhir = divicontabakhir.className;

    $(divicontabakhir).removeClass(classicontabakhir);

    var spans = $('#textTabakhir');

    var newclassname = "fa fa-refresh fa-3x";
    var newtextname = "ZAKAT";
    $(divicontabakhir).addClass(newclassname);

    for (i = 1; i <= 8; i++) {
        var nameliid = 'liTab'+i;
        var liTab = document.getElementById(nameliid);

        var divid = 'tab-'+i;
        var divTab = document.getElementById(divid);

        $(liTab).removeClass("active");
        $(divTab).removeClass("active");
    }

    $(litabakhir).addClass("active");
    $(divtabakhir).addClass("active");

    spans.text(newtextname);

    $('.h3Tabakhir').text("Bayar Zakat");
    $('#modal-lainnya').modal('hide');

    document.getElementById('formZakat').style.display = 'block';
    document.getElementById('formKartuKredit').style.display = 'none';
    document.getElementById('formEMoney').style.display = 'none';

}

function pilihemoney() {

    var divicontabakhir = document.getElementById('iconTabakhir');
    var litabakhir = document.getElementById('liTabakhir');
    var divtabakhir = document.getElementById('tab-9');
    var classicontabakhir = divicontabakhir.className;

    $(divicontabakhir).removeClass(classicontabakhir);

    var spans = $('#textTabakhir');

    var newclassname = "fa fa-road fa-3x";
    var newtextname = "E-Money";
    $(divicontabakhir).addClass(newclassname);

    for (i = 1; i <= 8; i++) {
        var nameliid = 'liTab'+i;
        var liTab = document.getElementById(nameliid);

        var divid = 'tab-'+i;
        var divTab = document.getElementById(divid);

        $(liTab).removeClass("active");
        $(divTab).removeClass("active");
    }

    $(litabakhir).addClass("active");
    $(divtabakhir).addClass("active");

    spans.text(newtextname);

    $('.h3Tabakhir').text("Bayar E-Money");
    $('#modal-lainnya').modal('hide');

    document.getElementById('formEMoney').style.display = 'block';
    document.getElementById('formZakat').style.display = 'none';
    document.getElementById('formKartuKredit').style.display = 'none';

}