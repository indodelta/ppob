<?php
$warna_lembaga=$_GET['warnalembaga'];

$kdprodukpgn= $dataproduk->produk[0]->kode;

?>

<form class="form-horizontal" id="formpgn" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off">

    <input type="hidden" class="form-control" name="txbjenistagihan" value="PGN">
    <input type="hidden" class="form-control" name="txbtab" value="6">

    <div class="form-group">
        <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga;?>">Nomor / ID Pelanggan :</label>
        <div class="col-lg-10">
            <div class="input-group m-b">
                <input type="hidden" name="txbproduk" id="txbproduk" value="<?php echo $kdprodukpgn?>">
                <input type="text" class="form-control" id="nomorpelangganpgn" name="nomorpelanggan" style="height: 50px;" placeholder="CONTOH 1122334455" required>
                <span class="input-group-addon"><img alt="image" src="<?php echo base_url();?>assets/img/logopgn.png" style="height: 30px; width: 20px;" /></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-danger" type="submit" style="float: right;" name="tombol">LANJUTKAN</button>
        </div>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_pgn.js"></script>

