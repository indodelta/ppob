<form class="form-horizontal" style="padding-left: 20px; padding-right: 20px;s" id="formtelkom" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off">

    <?php
    $warna_lembaga=$_GET['warnalembaga'];

    $datatelepon = $dataproduk->produk;
    $jmldatatelepon = count($datatelepon);
    $kodeprodukspeedy='';
    $kodeproduktelepon='';

    for ($x = 0; $x < $jmldatatelepon; $x++) {
        $namaproduk = $dataproduk->produk[$x]->nama;

        if($namaproduk == 'SPEEDY '){
            $kodeprodukspeedy = $dataproduk->produk[$x]->nama;
        }else if($namaproduk == 'TELEPON'){
            $kodeproduktelepon = $dataproduk->produk[$x]->nama;
        }
    };


    ?>

    <div class="form-group">
        <div class="i-checkstelkom col-lg-2">
            <label style="color: <?php echo $warna_lembaga;?>">
                <input type="radio"
                       checked=""
                       value="option1"
                       name="jenistelkom"
                       id="ichecksindihome"
                       class="ichecksindihome"
                       data-kode="<?php echo $kodeprodukspeedy ?>"
                > <i></i> IndiHome
            </label>
        </div>
        <div class="i-checkstelkom col-lg-2">
            <label style="color: <?php echo $warna_lembaga;?>">
                <input type="radio"
                       value="option2"
                       name="jenistelkom"
                       id="icheckstelepon"
                       class="icheckstelepon"
                       data-kode="<?php echo $kodeproduktelepon ?>"
                > <i></i> Telepon
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga;?>">Nomor Telp / ID Pel :</label>
        <div class="col-lg-10">
            <div class="input-group m-b">
                <input type="hidden" class="form-control" id="txbjenistelkom" name="txbjenistagihan" value="INDIHOME">
                <input type="hidden" class="form-control" name="txbtab" value="5">
                <input type="hidden" class="form-control" id="txbkodeproduk" name="txbkodeproduk" value="<?php echo $kodeprodukspeedy ?>">
                <input type="text" class="form-control" id="nomorpelanggantelkom" name="nomorpelanggan" style="height: 50px;" placeholder="CONTOH 1122334455" required>
                <span class="input-group-addon">
                    <img alt="image" id="imgindihome" src="<?php echo base_url();?>assets/img/logoindihome.png" style="height: 30px; width: 40px;" />
                    <img alt="image" id="imgtelkom" src="<?php echo base_url();?>assets/img/logotelkom.png" style="height: 30px; width: 40px; display: none;" />
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10 text-right">
            <button type="submit" name="tombol" value="billtelkom" class="btn btn-danger" style="width: 40%; margin-top: 30px;">LANJUTKAN</button>
        </div>
    </div>


</form>

<script src="<?php echo base_url();?>assets/js/js_telkom.js"></script>
<script>

    //input no telepon
    var nomorpelanggantelkom = document.getElementById('nomorpelanggantelkom');
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
    nomorpelanggantelkom.addEventListener('input', checkInputTel);

</script>