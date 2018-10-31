$(document).ready(function(){

    $.get('PELNI/get_origin', function(data){
        if(data){
            document.getElementById("loading").style.display = "none";
            if(data.name == ''){
                document.getElementById("alertapiasal").style.display = "block";
                document.getElementById("btnsubmit").disabled = true;
            }else{
                $(".origin").typeahead({source:data.name});
                document.getElementById("btnsubmit").disabled = false;
            }
        }
    },'json');

    $.get('PELNI/get_destination', function(data){
        if(data){
            document.getElementById("loading").style.display = "none";
            if(data.name == ''){
                document.getElementById("alertapitujuan").style.display = "block";
                document.getElementById("btnsubmit").disabled = true;
            }else{
                $(".destination").typeahead({source:data.name});
                document.getElementById("btnsubmit").disabled = false;
            }
        }
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

function clearori() {
    document.getElementById("origin").value = '';
}

function cleardest() {
    document.getElementById("destination").value = '';
}

function tukar() {
    var ori = document.getElementById("origin").value;
    var des = document.getElementById("destination").value;

    document.getElementById("destination").value = ori;
    document.getElementById("origin").value = des;
}

function showubahcari() {

    var formubahcari = document.getElementById('formubahcari');

    if (formubahcari.style.display !== 'block') {
        formubahcari.style.display = 'block';
    } else {
        formubahcari.style.display = 'none';
    }

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
                    }else{

                        if(jmlpria + jmlwanita + jmlbayi > 10 ){
                            swal({
                                title: "WARNING",
                                text: "Maaf, maks pembelian 10 Tiket!",
                                type: "warning",
                                confirmButtonColor: warnalembaga
                            });
                        }else{
                            document.getElementById('btnsubmit').type = "submit";
                            document.getElementById('formpesantiket').action = "pelni/jadwal";
                        }

                    }

                }

            }

        }
    }



}
