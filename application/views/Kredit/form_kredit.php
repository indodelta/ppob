<form class="form-horizontal" id="formangskredit" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off">

    <?php
    $warna_lembaga=$_GET['warnalembaga'];

    $dataopkredit = $dataproduk->operator;
    $jmldataopkredit = count($dataopkredit);

    ?>

    <input type="hidden" class="form-control" name="txbjenistagihan" value="ANGSKREDIT">
    <input type="hidden" class="form-control" name="txbtab" value="8">

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Pilih Jenis Asuransi/Finance :</label>
        <div class="col-lg-9">
            <select class="selectproviderkredit form-control" id="pilihanproviderkredit" name="pilihanproviderkredit" style="width: 100%;" required onchange="pilihproviderkredit()">
                <option>- Pilih Jenis Asuransi/Finance -</option>
                <?php
                for ($x = 0; $x < $jmldataopkredit; $x++) {
                    $namaoperator = $dataproduk->operator[$x]->opr_nama;
                    $idoperator = $dataproduk->operator[$x]->opr_id;
                    ?>
                    <option value="<?php echo $idoperator; ?>"><?php echo $namaoperator; ?></option>
                    <?php
                };
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Pilih Produk :</label>
        <div class="col-lg-9">
            <select class="selectprdouktv form-control" id="pilihanprodukkredit" name="pilihanprodukkredit" style="width: 100%;" required>
                <option>- Pilih Produk Asuransi/Finance -</option>
                <option> Anda belum memilih Provider</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Nomor / ID Pelanggan :</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan" placeholder="CONTOH 1122334455" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-danger" type="submit" id="billkredit" style="float: right;" name="tombol" value="billkredit">LANJUTKAN</button>
        </div>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_angskredit.js"></script>