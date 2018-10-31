<form class="form-horizontal" id="formtvkabel" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off">

    <?php
    $warna_lembaga=$_GET['warnalembaga'];

    $dataoptvkabel = $dataproduk->operator;
    $jmldataoptvkabel = count($dataoptvkabel);

    ?>

    <input type="hidden" class="form-control" name="txbjenistagihan" value="TVKABEL">

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Pilih Provider :</label>
        <div class="col-lg-9">
            <select class="selectprovidertv form-control" id="pilihanprovidertvkabel" name="pilihanprovidertvkabel" style="width: 100%;" required onchange="pilihprovidertvkabel()">
                <option>- Pilih Provider TV Kabel -</option>
                <?php
                for ($x = 0; $x < $jmldataoptvkabel; $x++) {
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
            <select class="selectprdouktv form-control" id="pilihanproduktvkabel" name="pilihanproduktvkabel" style="width: 100%;" required>
                <option>- Pilih Produk TV Kabel Provider -</option>
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
        <input type="hidden" class="form-control" name="txbtab" value="7">
        <div class="col-lg-12">
            <button class="btn btn-danger" type="submit" id="billtvkabel" style="float: right;" name="tombol" value="billtvkabel">LANJUTKAN</button>
        </div>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_tvkabel.js"></script>