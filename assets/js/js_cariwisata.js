$(document).ready(function(){

    $('.i-checks-durasi').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    $('.i-checks-propinsi').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    var jumlahwisata = document.getElementById("txbjumlahwisata").value;
    var iddiv = document.getElementById("txbnamadiv").value;

    var splitdiv = iddiv.split(',');

    var arrcheck = [];

    $('.durasi').on('ifChecked', function(event){

        for(var i = 0; i < jumlahwisata; i++) {
            var iddiv = splitdiv[i];

            document.getElementById(iddiv).style.display = "none";

        }

        var valuedurasi = event.target.value;

        if (arrcheck.indexOf(valuedurasi) < 0) {
            arrcheck.push(valuedurasi);
        }

        for (var j = 0; j < arrcheck.length; j++) {
            var namaclassvalue = '.' + arrcheck[j];
            $(namaclassvalue).css('display', 'block');
        }

    });

    $('.durasi').on('ifUnchecked', function(event){

        for(var i = 0; i < jumlahwisata; i++) {
            var iddiv = splitdiv[i];

            document.getElementById(iddiv).style.display = "none";

        }

        var valuedurasi = event.target.value;

        var index = arrcheck.indexOf(valuedurasi);
        if (index !== -1) arrcheck.splice(index, 1);

        if(arrcheck.length == 0){

            for(var i = 0; i < jumlahwisata; i++) {
                var iddiv = splitdiv[i];

                document.getElementById(iddiv).style.display = "block";

            }

        }else {

            for (var j = 0; j < arrcheck.length; j++) {
                var namaclassvalue = '.' + arrcheck[j];
                $(namaclassvalue).css('display', 'block');
            }

        }

    });

    $('.propinsi').on('ifChecked', function(event){

        for(var i = 0; i < jumlahwisata; i++) {
            var iddiv = splitdiv[i];

            document.getElementById(iddiv).style.display = "none";

        }

        var valueprop = event.target.value;

        if (arrcheck.indexOf(valueprop) < 0) {
            arrcheck.push(valueprop);
        }

        for (var j = 0; j < arrcheck.length; j++) {
            var namaclassvalue = '.' + arrcheck[j];
            $(namaclassvalue).css('display', 'block');
        }

    });

    $('.propinsi').on('ifUnchecked', function(event){

        for(var i = 0; i < jumlahwisata; i++) {
            var iddiv = splitdiv[i];

            document.getElementById(iddiv).style.display = "none";

        }

        var valueprop = event.target.value;

        var index = arrcheck.indexOf(valueprop);
        if (index !== -1) arrcheck.splice(index, 1);

        if(arrcheck.length == 0){

            for(var i = 0; i < jumlahwisata; i++) {
                var iddiv = splitdiv[i];

                document.getElementById(iddiv).style.display = "block";

            }

        }else {

            for (var j = 0; j < arrcheck.length; j++) {
                var namaclassvalue = '.' + arrcheck[j];
                $(namaclassvalue).css('display', 'block');
            }

        }


    });

});

function cleartxbkey() {
    document.getElementById("txbkey").value = '';
}
