$(document).ready(function(){

    $('.i-checkstelkom').iCheck({
        radioClass: 'iradio_square-red',
    });

    var nomorpelanggantelkom = document.getElementById('nomorpelanggantelkom');

    $('.ichecksindihome').on('ifChecked', function(event){
        var kode= $(this).attr('data-kode');

        document.getElementById("txbjenistelkom").value= 'INDIHOME';
        document.getElementById("txbkodeproduk").value= kode;
        document.getElementById("imgindihome").style.display= 'block';
        document.getElementById("imgtelkom").style.display= 'none';
        nomorpelanggantelkom.value = '';
    });

    $('.icheckstelepon').on('ifChecked', function(event){
        var kode= $(this).attr('data-kode');

        document.getElementById("txbjenistelkom").value= 'TELEPON';
        document.getElementById("txbkodeproduk").value= kode;
        document.getElementById("imgindihome").style.display= 'none';
        document.getElementById("imgtelkom").style.display= 'block';
        nomorpelanggantelkom.value = '';
    });

    $("#formtelkom").validate({

    });

});