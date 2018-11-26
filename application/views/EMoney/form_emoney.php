<?php
$warna_lembaga=$_GET['warnalembaga'];

$dataopemoney = $dataproduk->operator;
$jmldataopemoney = count($dataopemoney);
?>

<form class="form-horizontal" id="formemoney" method="post" autocomplete="off">

    <input type="hidden" class="form-control" name="txbjenistagihan" value="EMONEY">
    <input type="hidden" class="form-control" name="txbtab" value="12">

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Pilih Operator :</label>
        <div class="col-lg-9">
            <select class="selectoperatoremoney form-control" id="pilihanoperatoremoney" name="pilihanoperatoremoney" style="width: 100%;" required onchange="pilihoperatoremoney()">
                <option value="0">- Pilih Operator -</option>
                <?php
                for ($x = 0; $x < $jmldataopemoney; $x++) {
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
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Pilih Produk Operator :</label>
        <div class="col-lg-9">
            <select class="form-control" id="pilihanprodukemoney" name="pilihanprodukemoney" style="width: 100%;" required>
                <option value="0">- Pilih Produk Operator -</option>
                <option> Anda belum memilih Operator</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga ?>">Nomor Pelanggan :</label>
        <div class="col-lg-9" style="margin-bottom: 20px;">
            <input type="text" class="form-control" id="nomorpelangganemoney" name="txbnomorpelanggan" placeholder="08XXXXXXXX" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-danger" type="button" style="float: right;" name="tombol" onclick="beliemoney()">BELI</button>
        </div>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_emoney.js"></script>
