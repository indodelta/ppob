$(document).ready(function(){
    $("#formgameonline").validate({});

    //input no telepon
    var nomorpelanggangameonline = document.getElementById('nomorpelanggangameonline');
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
    nomorpelanggangameonline.addEventListener('input', checkInputTel);
})

function pilihoperatorgameonline() {

    var op = document.getElementById("pilihanoperatorgameonline");
    var opr_id = op.options[op.selectedIndex].value;
    var opr_name = op.options[op.selectedIndex].text;

    var prod = document.getElementById("pilihanprodukgameonline");
    $('#pilihanprodukgameonline').find("option:not(:first)").remove();

    $.get('GameOnline/getdatagameonlineproduk', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['produk'][i]['opr_id'];

            var option = document.createElement("option");

            if(data_opr_id == opr_id){
                var value = opr_name+','+datax['produk'][i]['kode']+','+datax['produk'][i]['nama']+','+datax['produk'][i]['harga'];
                var harga= datax['produk'][i]['harga'];
                var text = datax['produk'][i]['nama']+' ('+toRp(harga)+')';
                option.value = value;
                option.text = text;
                prod.add(option);
            }
        }

    });

}

function pilihprodukgameonline() {

    var op = document.getElementById("pilihanprodukgameonline");
    var opr_id = op.options[op.selectedIndex].value;

    $.get('GameOnline/getdatagameonlineproduk', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['produk'][i]['kode'];

            if(data_opr_id == opr_id){
                var kode= datax['produk'][i]['kode'];
                var nama= datax['produk'][i]['nama'];
                var harga= datax['produk'][i]['harga'];

                document.getElementById("txbprodukgameonline").value = kode;
                document.getElementById("txbnamaprodukgameonline").value = nama;
                // var rpharga= toRp(harga);
                document.getElementById("txbhargavoucher").value = harga;
                // $("#h2hargavoucher").html(rpharga);
            }
        }

    });

}

function belivouchergame() {
    var warnalembaga = document.getElementById("warnalembaga").value;
    var nomorpelanggan= document.getElementById("nomorpelanggangameonline").value;

    var op = document.getElementById("pilihanoperatorgameonline");
    var opr_id = op.options[op.selectedIndex].value;
    var op_pro = document.getElementById("pilihanprodukgameonline");
    var opr_pro_id = op_pro.options[op_pro.selectedIndex].value;

    if(nomorpelanggan == ''){

        swal({
            title: "WARNING",
            text: "Bidang nomor pelanggan wajib diisi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(opr_id == '0'){

        swal({
            title: "WARNING",
            text: "Bidang operator game online belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(opr_pro_id == '0'){

        swal({
            title: "WARNING",
            text: "Bidang produk game online belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else {

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan pembelian voucher game online ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formgameonline").action = "ppob/payment";
            document.getElementById("formgameonline").submit();
        });

    }
}