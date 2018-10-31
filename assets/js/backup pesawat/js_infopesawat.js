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
    var noteleponkontak = document.getElementById('noteleponkontak');
    noteleponkontak.addEventListener('input', checkInputTel);

   //form penumpang

    var jumlahdewasa = document.getElementById('txbjumlahdewasa').value;
    var jumlahanak = document.getElementById('txbjumlahanak').value;
    var jumlahbayi = document.getElementById('txbjumlahbayi').value;

    for (i = 1; i <= jumlahdewasa; i++) {

        var notelepondewasa = document.getElementById('notelepondewasa'+i);
        var nohandphonedewasa = document.getElementById('nohandphonedewasa'+i);
        notelepondewasa.addEventListener('input', checkInputTel);
        nohandphonedewasa.addEventListener('input', checkInputTel);

    }

    //tanggal lahir
    $('.tgllahir .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });


    $(".select-country").select2();

    $("#formbookpesawat").validate({});

})

function submittransflight() {
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
            text: "Anda akan melakukan pemesanan tiket pesawat ini?",
            showCancelButton: true,
            confirmButtonColor: warnalembaga,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            document.getElementById("formtransflight").action = "booking";
            document.getElementById("formtransflight").submit();
        });

    }
}