$(document).ready(function(){


});

function checkoutppob() {

    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var saldosekarang = document.getElementById('txbsaldosekarang').value;
    var nominal = document.getElementById('txbnominal').value;

    if(parseInt(saldosekarang) < parseInt(nominal)){

        swal({
            title: "WARNING",
            text: "Maaf, saldo anda tidak mencukupi !",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else{

        swal({
            title: "Anda Yakin?",
            text: "Anda akan melakukan transaksi ini ?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formCheckoutPPOB").action = "payment";
            document.getElementById("formCheckoutPPOB").submit();
        });

    }

}