$(document).ready(function(){

    var txbtambahpulsaberhasil = document.getElementById('txbtambahpulsaberhasil').value;

    if(txbtambahpulsaberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah melakukan transaksi pengisian pulsa ",
            type: "success"
        });

        document.getElementById('txbtambahpulsaberhasil').value = '';
    }

    var txbtambahdataberhasil = document.getElementById('txbtambahdataberhasil').value;

    if(txbtambahdataberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah melakukan transaksi pengisian data ",
            type: "success"
        });

        document.getElementById('txbtambahdataberhasil').value = '';
    }

    $("#formpulsa").validate({});
    $("#formdata").validate({});

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

    //input no telepon
    var nomorpelanggan = document.getElementById('nomorpelanggan');
    nomorpelanggan.addEventListener('input', checkInputTel);

    //input no telepon data
    var nomorpelanggandata = document.getElementById('nomorpelanggandata');
    nomorpelanggandata.addEventListener('input', checkInputTel);

})

function pilihoperator() {

    var op = document.getElementById("operatorpulsa");
    var opr_id = op.options[op.selectedIndex].value;
    var opr_name = op.options[op.selectedIndex].text;

    var nom = document.getElementById("nominalpulsa");
    $('#nominalpulsa').find("option:not(:first)").remove();

    $.get('pulsa/getdatapulsanominal', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['datapulsa']['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['datapulsa']['produk'][i]['opr_id'];
            harga = toRp(datax['datapulsa']['produk'][i]['harga']);

            var option = document.createElement("option");

            if(data_opr_id == opr_id){
                var value = opr_name+','+datax['datapulsa']['produk'][i]['kode']+','+datax['datapulsa']['produk'][i]['nama']+','+datax['datapulsa']['produk'][i]['harga'];
                option.value = value;
                option.text = datax['datapulsa']['produk'][i]['nama']+' ('+harga+')';
                nom.add(option);
            }
        }

    });

}

function beliPulsa() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var operatorpulsa = document.getElementById('operatorpulsa').value;
    var nominalpulsa = document.getElementById('nominalpulsa').value;
    var nomorpelanggan = document.getElementById('nomorpelanggan').value;

    if(operatorpulsa == ''){
        swal({
            title: "WARNING",
            text: "Bidang operator pulsa belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(nominalpulsa == ''){
        swal({
            title: "WARNING",
            text: "Bidang nominal pulsa belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(nomorpelanggan == ''){
        swal({
            title: "WARNING",
            text: "Bidang nomor pelanggan belum diisi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan pembelian pulsa ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formpulsa").action = "ppob/payment";
            document.getElementById("formpulsa").submit();
        });

    }
}

function pilihoperatordata() {

    var op = document.getElementById("operatordata");
    var opr_id = op.options[op.selectedIndex].value;
    var opr_name = op.options[op.selectedIndex].text;

    var nom = document.getElementById("nominaldata");
    $('#nominaldata').find("option:not(:first)").remove();

    $.get('pulsa/getdatapulsanominal', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['datadata']['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['datadata']['produk'][i]['opr_id'];
            harga = toRp(datax['datadata']['produk'][i]['harga']);

            var option = document.createElement("option");

            if(data_opr_id == opr_id){
                var value = opr_name+','+datax['datadata']['produk'][i]['kode']+','+datax['datadata']['produk'][i]['nama']+','+datax['datadata']['produk'][i]['harga'];
                option.value = value;
                option.text = datax['datadata']['produk'][i]['nama']+' ('+harga+')';
                nom.add(option);
            }
        }

    });

}

function beliData() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var operatordata = document.getElementById('operatordata').value;
    var nominaldata = document.getElementById('nominaldata').value;
    var nomorpelanggan = document.getElementById('nomorpelanggandata').value;

    if(operatordata == ''){
        swal({
            title: "WARNING",
            text: "Bidang operator data belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(nominaldata == ''){
        swal({
            title: "WARNING",
            text: "Bidang nominal data belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else if(nomorpelanggan == ''){
        swal({
            title: "WARNING",
            text: "Bidang nomor pelanggan belum diisi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }else{

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan pembelian data ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formdata").action = "ppob/payment";
            document.getElementById("formdata").submit();
        });

    }
}