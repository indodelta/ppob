<?php

$warna_lembaga=$_GET['warnalembaga'];

$dataopgameonline = $dataproduk->operator;
$jmldataopgameonline = count($dataopgameonline);
?>

<form class="form-horizontal" id="formgameonline" method="post" autocomplete="off">

    <input type="hidden" class="form-control" id="txbjenistagihan" name="txbjenistagihan" value="VOUCHERGAME">
    <input type="hidden" class="form-control" name="txbtab" value="4">
    <input type="hidden" name="txbproduk" id="txbprodukgameonline">
    <input type="hidden" name="txbnamaproduk" id="txbnamaprodukgameonline">

    <div class="col-lg-12" style="margin-bottom: 20px;">
        <label class="control-label" style="color: <?php echo $warna_lembaga ?>">NOMOR PELANGGAN :</label>
        <input type="text" class="form-control" id="nomorpelanggangameonline" name="txbnomorpelanggan" placeholder="08XXXXXXXX" required>
    </div>

    <div class="col-lg-12">

        <label class="control-label" style="color: <?php echo $warna_lembaga;?>">OPERATOR GAME ONLINE :</label>

        <select class="pilihanoperatorgameonline form-control" id="pilihanoperatorgameonline" name="pilihanoperatorgameonline" style="width: 100%;" required onchange="pilihoperatorgameonline()">
            <option value="0">- Pilih Operator Game Online -</option>
            <?php
            for ($x = 0; $x < $jmldataopgameonline; $x++) {
                $namaoperator = $dataproduk->operator[$x]->opr_nama;
                $idoperator = $dataproduk->operator[$x]->opr_id;
                ?>
                <option value="<?php echo $idoperator; ?>"><?php echo $namaoperator; ?></option>
                <?php
            };
            ?>
        </select>

    </div>

    <div class="col-lg-12" style="margin-top: 20px;">

        <label class="control-label" style="color: <?php echo $warna_lembaga;?>">PRODUK VOUCHER :</label>

        <select class="form-control" id="pilihanprodukgameonline" name="pilihanprodukgameonline" style="width: 100%;" required onchange="pilihprodukgameonline()">
            <option value="0">- Pilih Produk Voucher Operator -</option>
            <option> Anda belum memilih operator</option>
        </select>

    </div>

    <div class="form-group">
        <div class="col-lg-2">
<!--            <div id="nominalhargaprabayar">-->
                <input type="hidden" name="hargavoucher" id="txbhargavoucher">
<!--                <label class="control-label" style="color: --><?php //echo $warna_lembaga;?><!--">Harga :</label><br/>-->
<!--                <h2 id="h2hargavoucher"></h2>-->
<!--            </div>-->
        </div>
        <div class="col-lg-10 text-right" id="btnbelivouchergame" >
            <button type="button" name="tombol" value="billvouchergame" class="btn btn-danger" style="width: 40%; margin-top: 30px;" onclick="belivouchergame()">BELI</button>
        </div>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_gameonline.js"></script>
