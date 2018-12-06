$(document).ready(function(){

    $('.i-checks-durasi').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    var jenisdurasi = document.getElementById("txbjenisdurasi").value;
    var jumlahjenisdurasi = document.getElementById("txbjumlahjenisdurasi").value;
    var jumlahwisata = document.getElementById("txbjumlahwisata").value;

    $('.durasi').on('ifChecked', function(event){
        var value = event.target.value;

        var splitdurasi = jenisdurasi.split(',');

        for(var i = 0; i <= jumlahwisata; i++){
            var idiboxclick = 'ibox' + i + '-' + value + 'hari';
            console.log(idiboxclick);
            for(var j = 0; j < jumlahjenisdurasi; j++) {
                var idibox = 'ibox' + i + '-' + splitdurasi[j] + 'hari';
                console.log(idibox);

                if(idibox == idiboxclick){
                    console.log('sama');
                }

            }
        }

        // var splitdurasi = jenisdurasi.split(',');
        // for(var i = 0; i < jumlahjenisdurasi; i++){
        //     var iddivlain = '.div-'+splitdurasi[i]+'hari';
        //     document.getElementsByClassName(iddivlain).style.display = "none";
        // }



    });

    $('.durasi').on('ifUnchecked', function(event){
        var value = event.target.value;

        // for(var i = 0; i <= jumlahwisata; i++){
        //     var iddiv = 'ibox'+i+'-'+value+'hari';
        //
        //     document.getElementById(iddiv).style.display = "block";
        // }

    });

});

function cleartxbkey() {
    document.getElementById("txbkey").value = '';
}
