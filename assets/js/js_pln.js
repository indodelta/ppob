$(document).ready(function(){

    $('.i-checks').iCheck({
        radioClass: 'iradio_square-red',
    });

    $('.icheckstoken').on('ifChecked', function(event){
        document.getElementById("formtokenpln").style.display= 'block';
        document.getElementById("formtagihanpln").style.display= 'none';
    });

    $('.icheckstagihan').on('ifChecked', function(event){
        document.getElementById("formtokenpln").style.display= 'none';
        document.getElementById("formtagihanpln").style.display= 'block';
    });

    $("#formtokenpln").validate({

    });

    $("#formtagihanpln").validate({

    });


});

function pilihtoken(button) {

    var nominal= $(button).attr('data-nominal');
    var nomnal= $(button).attr('data-nomnal');
    var nama= $(button).attr('data-nama');

    // document.getElementById("txbkodetoken").value= kode;
    // document.getElementById("txbhargatoken").value= harga;
    document.getElementById("txbnominaltoken").value= nominal;
    document.getElementById("txbnamaproduk").value= nama;

    $("#h2token").html(nomnal);

}

function belitoken() {
    var warnalembaga = document.getElementById("warnalembaga").value;
    var txbnominaltoken = document.getElementById("txbnominaltoken").value;
    var txbsaldosekarang = document.getElementById("txbsaldosekarang").value;
    var nomoridpelanggan = document.getElementById("nomoridpelanggan").value;

    if(nomoridpelanggan == ''){
        swal({
            title: "WARNING",
            text: "Bidang nomor pelanggan wajib diisi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });
    }
    else if(parseInt(txbnominaltoken) > parseInt(txbsaldosekarang)){

        swal({
            title: "WARNING",
            text: "Maaf, Saldo anda tidak mencukupi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else {

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan pembelian token ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formtokenpln").action = "ppob/checkout";
            document.getElementById("formtokenpln").submit();
        });


    }

}