$(document).ready(function(){

    var txbbatalsaldoberhasil = document.getElementById('txbbatalsaldoberhasil').value;
    var txbtambahsaldoberhasil = document.getElementById('txbtambahsaldoberhasil').value;

    if(txbbatalsaldoberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah membatalkan penambahan saldo dengan id transaksi "+txbbatalsaldoberhasil,
            type: "success"
        });

        document.getElementById('txbbatalsaldoberhasil').value = '';
    }

    if(txbtambahsaldoberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah menambahkan penambahan saldo dengan id transaksi "+txbtambahsaldoberhasil,
            type: "success"
        });

        document.getElementById('txbbatalsaldoberhasil').value = '';
    }

    $('.datatransaksisaldo').DataTable({
        responsive: true,
        aaSorting: [ [1,'desc']],
    });

    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

});

function uploadImage() {
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var txbNameimg = document.getElementById("txbNameimg").value;
    var txbImginp = document.getElementById("imgInp").files[0].size;
    var sizeImg = (txbImginp/1024).toFixed(0);

    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

    if(txbNameimg == ''){

        swal({
            title: "WARNING",
            text: "Anda belum mengupload gambar",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }else{

        if (txbNameimg.length > 0) {

                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (txbNameimg.substr(txbNameimg.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {

                    swal({
                        title: "WARNING",
                        text: "Type file extension tidak diizinkan !!",
                        type: "warning",
                        confirmButtonColor: warnalembaga
                    });

                    return false;
                }

        }

        if(sizeImg >1000){

            swal({
                title: "WARNING",
                text: "Maksimum size gambar 1000Kb / 1 Mb",
                type: "warning",
                confirmButtonColor: warnalembaga
            });

        }else{

            swal({
                title: "Anda Yakin?",
                text: "Anda akan upload image bukti transfer ini?",
                showCancelButton: true,
                confirmButtonColor: warnalembaga,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            }, function () {
                document.getElementById("formTambahBukti").action = "../Deposit/uploadimage";
                document.getElementById("formTambahBukti").submit();
            });

        }

    }

}

function lihatGambar(button) {

    var txbPathnameImg = $(button).attr('data-file');

    var src= "../uploads/"+txbPathnameImg;

    document.getElementById("imgBuktiTransfer").src = src;

    $("#modalImgBukti").modal('show',{backdrop: 'true'});

}

function lihatSaldouser(button) {

    var iduser= $(button).attr('data-iduser');

    $("#modalSaldoUser").modal('show',{backdrop: 'true'});

    $("#txtiduser").html(iduser);

    $.get('lihatsaldo', {id: iduser}, function(data){

        var obj = JSON.parse(data);
        var nama = obj[0]['nama'];
        var alamat = obj[0]['alamat'];
        var email = obj[0]['email'];
        var telepon = obj[0]['telepon'];
        var saldo = obj[0]['saldo'];

        $("#txtnamauser").html(nama);
        $("#txtnotelpuser").html(telepon);
        $("#txtemailuser").html(email);
        $("#txtalamatuser").html(alamat);
        $("#txtsaldouser").html(toRp(saldo));

    });
}

function batalkanSaldo(elem){

    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var id = $(elem).data("id");

    var namaform = 'formTambahBatalSaldo'+id;

    swal({
        title: "Anda Yakin?",
        text: "Anda akan membatalkan penambahan saldo untuk ID Transaksi "+id+" ?",
        showCancelButton: true,
        confirmButtonColor: warnalembaga,
        confirmButtonText: "Ya",
        closeOnConfirm: false
    }, function () {

        document.getElementById(namaform).action = "../Deposit/batalkansaldo";
        document.getElementById(namaform).submit();

    });

}

function tambahSaldo(elem){

    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var nominal = parseInt(document.getElementById('txbnominal').value);
    var id = $(elem).data("id");

    var namaform = 'formTambahBatalSaldo'+id;

    swal({
        title: "Anda Yakin?",
        text: "Anda akan menambahkan saldo untuk ID Transaksi "+id+" ?",
        showCancelButton: true,
        confirmButtonColor: warnalembaga,
        confirmButtonText: "Ya",
        closeOnConfirm: false
    }, function () {
        document.getElementById(namaform).action = "../Deposit/tambahsaldo";
        document.getElementById(namaform).submit();
    });


}