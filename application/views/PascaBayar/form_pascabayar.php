<form class="form-horizontal" id="formpascabayar" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off">

    <?php $warna_lembaga=$_GET['warnalembaga']; ?>

    <input type="hidden" class="form-control" name="txbjenistagihan" value="PASCABAYAR">
    <input type="hidden" class="form-control" name="txbtab" value="1">

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Jenis Tagihan :</label>
        <div class="col-lg-9">
            <select class="form-control m-b" name="jenistagihan" required>
                <option value="0">Tagihan HALO - Telkomsel Pascabayar</option>
                <option value="1">Tagihan MATRIX - Indosat Pascabayar</option>
                <option value="2">Tagihan Xplor - XL Pascabayar</option>
                <option value="3">Tagihan ESIA - Esia Pascabayar</option>
                <option value="4">Tagihan SMARTFREN - Smartfren Pascabayar</option>
                <option value="5">Tagihan THREE - Three Pascabayar</option>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Nomor Pelanggan :</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan" placeholder="08XXXXXXXX" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-danger" type="submit" id="billpasca" style="float: right;" name="tombol" value="billpasca">LANJUTKAN</button>
        </div>
    </div>

</form>

<script>
    $("#formpascabayar").validate({


    });

    //input no telepon
    var nomorpelanggan = document.getElementById('nomorpelanggan');
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
    nomorpelanggan.addEventListener('input', checkInputTel);

</script>