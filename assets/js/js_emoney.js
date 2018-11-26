$(document).ready(function(){

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
    var nomorpelanggan = document.getElementById('nomorpelangganemoney');
    nomorpelanggan.addEventListener('input', checkInputTel);

})


function pilihoperatoremoney() {

    var op = document.getElementById("pilihanoperatoremoney");
    var opr_id = op.options[op.selectedIndex].value;
    var opr_name = op.options[op.selectedIndex].text;

    var nom = document.getElementById("pilihanprodukemoney");
    $('#pilihanprodukemoney').find("option:not(:first)").remove();

    $.get('EMoney/getdataemoneyproduk', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['produk'][i]['opr_id'];

            var option = document.createElement("option");

            if(data_opr_id == opr_id){
                var value = opr_name+','+datax['produk'][i]['kode']+','+datax['produk'][i]['nama']+','+datax['produk'][i]['harga'];
                option.value = value;
                option.text = datax['produk'][i]['nama'];
                nom.add(option);
            }
        }

    });

}

function beliemoney() {
    var warnalembaga = document.getElementById("warnalembaga").value;
    var nomorpelanggan= document.getElementById("nomorpelangganemoney").value;

    var op = document.getElementById("pilihanoperatoremoney");
    var opr_id = op.options[op.selectedIndex].value;
    var op_pro = document.getElementById("pilihanprodukemoney");
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
            text: "Bidang operator belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(opr_pro_id == '0'){

        swal({
            title: "WARNING",
            text: "Bidang produk operator belum dipilih!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else {

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan pembelian produk ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formemoney").action = "ppob/payment";
            document.getElementById("formemoney").submit();
        });

    }
}
