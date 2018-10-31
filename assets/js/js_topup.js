$(document).ready(function(){

    $("#formtopupsaldo").validate({

    });

});

function pilihmetode() {

    var met = document.getElementById("metodepopup");
    var met_val = met.options[met.selectedIndex].value;

    if(met_val == 'transferbanka'){
        document.getElementById("norekeningtujuanbanka").style.display = 'block';
        document.getElementById("norekeningtujuanbankb").style.display = 'none';
        document.getElementById("norekeningtujuanbankc").style.display = 'none';
        document.getElementById("txbbankrekeningtujuan").value = 'Bank A';
        document.getElementById("txbnorekeningtujuan").value = 'A-11111111-11';
        document.getElementById("txbanrekeningtujuan").value = 'Head Bank A';
    }else if(met_val == 'transferbankb'){
        document.getElementById("norekeningtujuanbankb").style.display = 'block';
        document.getElementById("norekeningtujuanbanka").style.display = 'none';
        document.getElementById("norekeningtujuanbankc").style.display = 'none';
        document.getElementById("txbbankrekeningtujuan").value = 'Bank B';
        document.getElementById("txbnorekeningtujuan").value = 'B-11111111-11';
        document.getElementById("txbanrekeningtujuan").value = 'Head Bank B';
    }else if(met_val == 'transferbankc'){
        document.getElementById("norekeningtujuanbankc").style.display = 'block';
        document.getElementById("norekeningtujuanbankb").style.display = 'none';
        document.getElementById("norekeningtujuanbanka").style.display = 'none';
        document.getElementById("txbbankrekeningtujuan").value = 'Bank C';
        document.getElementById("txbnorekeningtujuan").value = 'C-11111111-11';
        document.getElementById("txbanrekeningtujuan").value = 'Head Bank C';
    }

}

function formatangka() {
    var a = formtopupsaldo.txbnominaltopup.value.replace(/[^\d]/g, "");

    var a = +a;

    formtopupsaldo.txbnominaltopup.value = formatNum(a);
    formtopupsaldo.txbnominal.value = a;
}

function formatNum(rawNum) {
    rawNum = "" + rawNum; // converts the given number back to a string
    var retNum = "";
    var j = 0;
    for (var i = rawNum.length; i > 0; i--) {
        j++;
        if (((j % 3) == 1) && (j != 1))
            retNum = rawNum.substr(i - 1, 1) + "." + retNum;
        else
            retNum = rawNum.substr(i - 1, 1) + retNum;
    }
    return retNum;
}

function btntopupsaldo() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var met = document.getElementById("metodepopup");
    var met_val = met.options[met.selectedIndex].value;
    var nominaltopup = document.getElementById('txbnominaltopup').value;
    var nominal = nominaltopup.split('.').join('');
    var namapengirim = document.getElementById('txbnamapengirim').value;

    if(met_val == '-'){

        swal({
            title: "WARNING",
            text: "Anda belum memilih metode pembayaran TopUp!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(nominaltopup == ''){

        swal({
            title: "WARNING",
            text: "Bidang Nominal Top Up wajib diisi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(nominal < 50000){

        swal({
            title: "WARNING",
            text: "Nominal top up minimal 50.000!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else if(namapengirim == ''){

        swal({
            title: "WARNING",
            text: "Bidang Nama Pengirim wajib diisi!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else{

        swal({
            title: "Anda Yakin?",
            text: "Anda akan top up saldo anda senilai "+nominaltopup+" ?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formtopupsaldo").action = "../deposit/topupsaldo";
            document.getElementById("formtopupsaldo").submit();
        });

    }
}