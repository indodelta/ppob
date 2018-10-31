<form class="form-horizontal" id="formpdam" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off">

    <?php

    $warna_lembaga=$_GET['warnalembaga'];

    $datapdam = $dataproduk->produk;
    $jmldatapdam = count($datapdam);

    ?>

    <input type="hidden" class="form-control" name="txbjenistagihan" value="PDAM">
    <input type="hidden" class="form-control" name="txbtab" value="3">

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Pilih PDAM :</label>
        <div class="col-lg-9">
            <select class="selectpdam form-control" name="pilihanpdam" style="width: 100%;" required>
                <option></option>
                <?php
                for ($x = 0; $x < $jmldatapdam; $x++) {
                    $namapdam = $dataproduk->produk[$x]->nama;
                    $kodepdam = $dataproduk->produk[$x]->kode;
                    $valuepdam = $kodepdam.'-'.$namapdam;
                        ?>
                        <option value="<?php echo $valuepdam; ?>"><?php echo $namapdam; ?></option>
                        <?php
                };
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Nomor / ID Pelanggan :</label>
        <div class="col-lg-9 input-group">
            <input type="hidden" class="form-control" id="jenistagihan" name="jenistagihan" value="PDAM">
            <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan" style="height: 50px;" placeholder="CONTOH 1122334455" required>
            <span class="input-group-addon">
                <img alt="image" id="imgpdam" src="<?php echo base_url();?>assets/img/logopdam.png" style="height: 30px; width: 40px;" />
            </span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-danger" type="submit" id="billpdam" style="float: right;" name="tombol" value="billpdam">LANJUTKAN</button>
        </div>
    </div>

</form>

<script>
    $("#formpdam").validate({});
    $(".selectpdam").select2();
</script>